<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use App\Models\WorkerType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Fields that belong to the worker profile instead of the user record.
     *
     * @var list<string>
     */
    private const WORKER_FIELDS = ['worker_type_id', 'service_area', 'experience_years', 'description', 'status'];

    /**
     * List users, optionally filtered by `search` (name/email) and `role`.
     */
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();
        $role = $request->string('role')->toString();

        $users = User::query()
            ->with('worker.workerType:id,name')
            ->when($search !== '', fn (Builder $query) => $query->where(
                fn (Builder $query) => $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
            ))
            ->when(in_array($role, ['admin', 'tukang', 'pelanggan'], true), fn (Builder $query) => $query->where('role', $role))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
            'search' => $search,
            'role' => $role,
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'workerTypes' => $this->workerTypeOptions(),
        ]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $user = User::create($request->safe()->only(['name', 'email', 'phone', 'address', 'password', 'role']));

            if ($user->role === 'tukang') {
                $user->worker()->create($this->workerData($request));
            }
        });

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function show(User $user): View
    {
        return view('admin.users.show', [
            'user' => $user->load('worker.workerType:id,name'),
        ]);
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user->load('worker'),
            'workerTypes' => $this->workerTypeOptions(),
        ]);
    }

    /**
     * Update the user. The password is only changed when a new one is filled in.
     * Switching away from "tukang" removes the worker profile.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        DB::transaction(function () use ($request, $user): void {
            $userData = $request->safe()->only(['name', 'email', 'phone', 'address', 'role']);

            if ($request->filled('password')) {
                $userData['password'] = $request->validated('password');
            }

            $user->update($userData);

            if ($user->role === 'tukang') {
                $user->worker()->updateOrCreate([], $this->workerData($request));
            } else {
                $user->worker()->delete();
            }
        });

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($user->is($request->user())) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function workerData(StoreUserRequest $request): array
    {
        $workerData = $request->safe()->only(self::WORKER_FIELDS);
        $workerData['status'] ??= 'active';

        return $workerData;
    }

    /**
     * @return Collection<int, WorkerType>
     */
    private function workerTypeOptions(): Collection
    {
        return WorkerType::query()->orderBy('name')->get(['id', 'name']);
    }
}
