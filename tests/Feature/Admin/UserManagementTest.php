<?php

use App\Models\User;
use App\Models\Worker;
use App\Models\WorkerType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => 'admin']);
});

test('non-admins cannot manage users', function (string $role) {
    $user = User::factory()->create(['role' => $role]);

    $this->actingAs($user)->post(route('admin.users.store'), [])->assertForbidden();
    $this->actingAs($user)->delete(route('admin.users.destroy', $this->admin))->assertForbidden();
})->with(['tukang', 'pelanggan']);

test('admin can create a customer', function () {
    $this->actingAs($this->admin)
        ->post(route('admin.users.store'), [
            'name' => 'Rina',
            'email' => 'rina@example.com',
            'phone' => '0811111111',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'pelanggan',
            'service_area' => 'diabaikan karena bukan tukang',
        ])
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('success');

    $user = User::query()->where('email', 'rina@example.com')->firstOrFail();

    expect($user->role)->toBe('pelanggan')
        ->and($user->phone)->toBe('0811111111')
        ->and(Hash::check('password123', $user->password))->toBeTrue()
        ->and($user->worker)->toBeNull();
});

test('admin can create a worker together with the worker profile', function () {
    $workerType = WorkerType::factory()->create();

    $this->actingAs($this->admin)
        ->post(route('admin.users.store'), [
            'name' => 'Andi',
            'email' => 'andi@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'tukang',
            'worker_type_id' => $workerType->id,
            'service_area' => 'Jakarta',
            'experience_years' => 4,
        ])
        ->assertRedirect(route('admin.users.index'));

    $user = User::query()->where('email', 'andi@example.com')->firstOrFail();

    $this->assertDatabaseHas('workers', [
        'user_id' => $user->id,
        'worker_type_id' => $workerType->id,
        'service_area' => 'Jakarta',
        'experience_years' => 4,
        'status' => 'active',
    ]);
});

test('worker profile fields are required for the tukang role', function () {
    $this->actingAs($this->admin)
        ->post(route('admin.users.store'), [
            'name' => 'Andi',
            'email' => 'andi@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'tukang',
        ])
        ->assertSessionHasErrors(['worker_type_id', 'service_area', 'experience_years']);

    $this->assertDatabaseMissing('users', ['email' => 'andi@example.com']);
});

test('admin can update a user and keep the password when it is left empty', function () {
    $user = User::factory()->create(['role' => 'pelanggan']);
    $originalPassword = $user->password;

    $this->actingAs($this->admin)
        ->put(route('admin.users.update', $user), [
            'name' => 'Nama Baru',
            'email' => $user->email,
            'role' => 'pelanggan',
            'password' => '',
            'password_confirmation' => '',
        ])
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHasNoErrors();

    expect($user->fresh())
        ->name->toBe('Nama Baru')
        ->password->toBe($originalPassword);
});

test('changing a worker to another role removes the worker profile', function () {
    $user = User::factory()->create(['role' => 'tukang']);
    Worker::create([
        'user_id' => $user->id,
        'worker_type_id' => WorkerType::factory()->create()->id,
        'service_area' => 'Bogor',
        'experience_years' => 2,
    ]);

    $this->actingAs($this->admin)
        ->put(route('admin.users.update', $user), [
            'name' => $user->name,
            'email' => $user->email,
            'role' => 'pelanggan',
        ])
        ->assertSessionHasNoErrors();

    $this->assertDatabaseMissing('workers', ['user_id' => $user->id]);
});

test('changing a user to tukang creates the worker profile', function () {
    $user = User::factory()->create(['role' => 'pelanggan']);
    $workerType = WorkerType::factory()->create();

    $this->actingAs($this->admin)
        ->put(route('admin.users.update', $user), [
            'name' => $user->name,
            'email' => $user->email,
            'role' => 'tukang',
            'worker_type_id' => $workerType->id,
            'service_area' => 'Depok',
            'experience_years' => 1,
            'status' => 'inactive',
        ])
        ->assertSessionHasNoErrors();

    $this->assertDatabaseHas('workers', [
        'user_id' => $user->id,
        'worker_type_id' => $workerType->id,
        'status' => 'inactive',
    ]);
});

test('admin cannot remove their own admin role', function () {
    $this->actingAs($this->admin)
        ->put(route('admin.users.update', $this->admin), [
            'name' => $this->admin->name,
            'email' => $this->admin->email,
            'role' => 'pelanggan',
        ])
        ->assertSessionHasErrors('role');

    expect($this->admin->fresh()->role)->toBe('admin');
});

test('admin can delete another user', function () {
    $user = User::factory()->create(['role' => 'pelanggan']);

    $this->actingAs($this->admin)
        ->delete(route('admin.users.destroy', $user))
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('success');

    $this->assertModelMissing($user);
});

test('admin cannot delete their own account', function () {
    $this->actingAs($this->admin)
        ->delete(route('admin.users.destroy', $this->admin))
        ->assertSessionHas('error');

    $this->assertModelExists($this->admin);
});

test('admin can view the user list with search and role filters', function () {
    User::factory()->create(['name' => 'Budi Tukang', 'role' => 'tukang']);
    User::factory()->create(['name' => 'Budi Pelanggan', 'role' => 'pelanggan']);

    $this->actingAs($this->admin)
        ->get(route('admin.users.index', ['search' => 'Budi', 'role' => 'tukang']))
        ->assertOk()
        ->assertViewIs('admin.users.index')
        ->assertSee('Budi Tukang')
        ->assertDontSee('Budi Pelanggan');
});

test('admin can view the create and edit forms', function () {
    $workerType = WorkerType::factory()->create(['name' => 'Tukang Atap']);
    $user = User::factory()->create(['role' => 'pelanggan', 'name' => 'Sinta']);

    $this->actingAs($this->admin)
        ->get(route('admin.users.create'))
        ->assertOk()
        ->assertSee('action="'.route('admin.users.store').'"', false)
        ->assertSee('Tukang Atap');

    $this->actingAs($this->admin)
        ->get(route('admin.users.edit', $user))
        ->assertOk()
        ->assertSee('action="'.route('admin.users.update', $user).'"', false)
        ->assertSee('value="Sinta"', false)
        ->assertSee('value="'.$workerType->id.'"', false);
});

test('admin can view user details including the worker profile', function () {
    $user = User::factory()->create(['role' => 'tukang', 'name' => "D'Angelo"]);
    Worker::create([
        'user_id' => $user->id,
        'worker_type_id' => WorkerType::factory()->create(['name' => 'Tukang Pipa'])->id,
        'service_area' => 'Medan',
        'experience_years' => 7,
    ]);

    $this->actingAs($this->admin)
        ->get(route('admin.users.show', $user))
        ->assertOk()
        ->assertSee("D'Angelo")
        ->assertSee('Hapus pengguna D'.chr(92).'u0027Angelo?', false)
        ->assertSee('Tukang Pipa')
        ->assertSee('Medan');
});

test('flash messages are shown after redirecting back to the list', function () {
    $user = User::factory()->create(['role' => 'pelanggan']);

    $this->actingAs($this->admin)
        ->followingRedirects()
        ->delete(route('admin.users.destroy', $user))
        ->assertOk()
        ->assertSee('Pengguna berhasil dihapus.');
});
