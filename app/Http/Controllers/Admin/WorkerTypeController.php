<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWorkerTypeRequest;
use App\Http\Requests\Admin\UpdateWorkerTypeRequest;
use App\Models\WorkerType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkerTypeController extends Controller
{
    /**
     * List worker types with the number of workers, optionally filtered by `search`.
     */
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();

        $workerTypes = WorkerType::query()
            ->withCount('workers')
            ->when($search !== '', fn (Builder $query) => $query->where('name', 'like', "%{$search}%"))
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.worker-types.index', [
            'workerTypes' => $workerTypes,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return view('admin.worker-types.create');
    }

    public function store(StoreWorkerTypeRequest $request): RedirectResponse
    {
        WorkerType::create($request->validated());

        return redirect()->route('admin.worker-types.index')->with('success', 'Jenis tukang berhasil ditambahkan.');
    }

    public function show(WorkerType $workerType): View
    {
        return view('admin.worker-types.show', [
            'workerType' => $workerType->load('workers.user:id,name,email,phone')->loadCount('workers'),
        ]);
    }

    public function edit(WorkerType $workerType): View
    {
        return view('admin.worker-types.edit', [
            'workerType' => $workerType,
        ]);
    }

    public function update(UpdateWorkerTypeRequest $request, WorkerType $workerType): RedirectResponse
    {
        $workerType->update($request->validated());

        return redirect()->route('admin.worker-types.index')->with('success', 'Jenis tukang berhasil diperbarui.');
    }

    /**
     * Worker types still in use are kept, because deleting them would cascade-delete worker profiles.
     */
    public function destroy(WorkerType $workerType): RedirectResponse
    {
        if ($workerType->workers()->exists()) {
            return back()->with('error', 'Jenis tukang masih digunakan oleh tukang dan tidak dapat dihapus.');
        }

        $workerType->delete();

        return redirect()->route('admin.worker-types.index')->with('success', 'Jenis tukang berhasil dihapus.');
    }
}
