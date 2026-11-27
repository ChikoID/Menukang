<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Worker;
use App\Models\WorkerType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Send the user to the dashboard that matches their role.
     */
    public function index(Request $request): RedirectResponse|View
    {
        return match ($request->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'tukang' => redirect()->route('tukang.dashboard'),
            'pelanggan' => redirect()->route('pelanggan.dashboard'),
            default => view('dashboard.index'),
        };
    }

    public function admin(): View
    {
        $userCountsByRole = User::query()
            ->selectRaw('role, count(*) as total')
            ->groupBy('role')
            ->pluck('total', 'role');

        return view('dashboard.admin', [
            'totalUsers' => $userCountsByRole->sum(),
            'totalTukang' => $userCountsByRole->get('tukang', 0),
            'totalPelanggan' => $userCountsByRole->get('pelanggan', 0),
            'totalWorkerTypes' => WorkerType::query()->count(),
            'latestUsers' => User::query()
                ->latest()
                ->paginate(5, ['id', 'name', 'email', 'role', 'created_at'])
                ->withQueryString(),
        ]);
    }

    public function tukang(Request $request): View
    {
        return view('dashboard.tukang', [
            'worker' => Worker::query()
                ->with('workerType:id,name')
                ->where('user_id', $request->user()->id)
                ->first(),
        ]);
    }

    public function pelanggan(): View
    {
        return view('dashboard.pelanggan', [
            'totalWorkers' => Worker::query()->where('status', 'active')->count(),
            'workerTypes' => WorkerType::query()
                ->orderBy('name')
                ->paginate(6, ['id', 'name', 'description'])
                ->withQueryString(),
        ]);
    }
}
