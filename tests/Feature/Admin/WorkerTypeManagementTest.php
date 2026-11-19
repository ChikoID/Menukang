<?php

use App\Models\User;
use App\Models\Worker;
use App\Models\WorkerType;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => 'admin']);
});

test('non-admins cannot manage worker types', function () {
    $user = User::factory()->create(['role' => 'pelanggan']);

    $this->actingAs($user)
        ->post(route('admin.worker-types.store'), ['name' => 'Tukang Las'])
        ->assertForbidden();

    $this->assertDatabaseMissing('worker_types', ['name' => 'Tukang Las']);
});

test('admin can create a worker type', function () {
    $this->actingAs($this->admin)
        ->post(route('admin.worker-types.store'), [
            'name' => 'Tukang Las',
            'description' => 'Pengelasan besi dan pagar',
        ])
        ->assertRedirect(route('admin.worker-types.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('worker_types', [
        'name' => 'Tukang Las',
        'description' => 'Pengelasan besi dan pagar',
    ]);
});

test('worker type names must be unique', function () {
    WorkerType::factory()->create(['name' => 'Tukang Las']);

    $this->actingAs($this->admin)
        ->post(route('admin.worker-types.store'), ['name' => 'Tukang Las'])
        ->assertSessionHasErrors('name');
});

test('admin can update a worker type and keep its own name', function () {
    $workerType = WorkerType::factory()->create(['name' => 'Tukang Las']);

    $this->actingAs($this->admin)
        ->put(route('admin.worker-types.update', $workerType), [
            'name' => 'Tukang Las',
            'description' => 'Deskripsi baru',
        ])
        ->assertRedirect(route('admin.worker-types.index'))
        ->assertSessionHasNoErrors();

    expect($workerType->fresh()->description)->toBe('Deskripsi baru');
});

test('admin can delete an unused worker type', function () {
    $workerType = WorkerType::factory()->create();

    $this->actingAs($this->admin)
        ->delete(route('admin.worker-types.destroy', $workerType))
        ->assertRedirect(route('admin.worker-types.index'))
        ->assertSessionHas('success');

    $this->assertModelMissing($workerType);
});

test('a worker type that is still used cannot be deleted', function () {
    $workerType = WorkerType::factory()->create();
    Worker::create([
        'user_id' => User::factory()->create(['role' => 'tukang'])->id,
        'worker_type_id' => $workerType->id,
        'service_area' => 'Bekasi',
        'experience_years' => 3,
    ]);

    $this->actingAs($this->admin)
        ->delete(route('admin.worker-types.destroy', $workerType))
        ->assertSessionHas('error');

    $this->assertModelExists($workerType);
    $this->assertDatabaseCount('workers', 1);
});

test('admin can view the worker type list with worker counts', function () {
    $workerType = WorkerType::factory()->create(['name' => 'Tukang Kaca']);
    WorkerType::factory()->create(['name' => 'Tukang Batu']);
    Worker::create([
        'user_id' => User::factory()->create(['role' => 'tukang'])->id,
        'worker_type_id' => $workerType->id,
        'service_area' => 'Solo',
        'experience_years' => 1,
    ]);

    $this->actingAs($this->admin)
        ->get(route('admin.worker-types.index', ['search' => 'Kaca']))
        ->assertOk()
        ->assertViewIs('admin.worker-types.index')
        ->assertSee('Tukang Kaca')
        ->assertDontSee('Tukang Batu');
});

test('admin can view the worker type forms and details', function () {
    $workerType = WorkerType::factory()->create(['name' => 'Tukang Keramik']);
    $worker = User::factory()->create(['role' => 'tukang', 'name' => 'Pak Harto']);
    Worker::create([
        'user_id' => $worker->id,
        'worker_type_id' => $workerType->id,
        'service_area' => 'Malang',
        'experience_years' => 10,
    ]);

    $this->actingAs($this->admin)
        ->get(route('admin.worker-types.create'))
        ->assertOk()
        ->assertSee('action="'.route('admin.worker-types.store').'"', false);

    $this->actingAs($this->admin)
        ->get(route('admin.worker-types.edit', $workerType))
        ->assertOk()
        ->assertSee('value="Tukang Keramik"', false);

    $this->actingAs($this->admin)
        ->get(route('admin.worker-types.show', $workerType))
        ->assertOk()
        ->assertSee('Pak Harto')
        ->assertSee('Malang');
});
