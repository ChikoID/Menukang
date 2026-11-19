<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Worker;
use App\Models\WorkerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function showRegistrationForm(): View
    {
        return view('auth.register', [
            'workerTypes' => WorkerType::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:tukang,pelanggan'],
            'worker_type_id' => ['required_if:role,tukang', 'nullable', 'exists:worker_types,id'],
            'service_area' => ['required_if:role,tukang', 'nullable', 'string'],
            'experience_years' => ['required_if:role,tukang', 'nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.string' => 'Alamat email harus berupa teks.',
            'email.email' => 'Masukkan alamat email yang valid.',
            'email.max' => 'Alamat email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Alamat email sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'password.min' => 'Kata sandi harus memiliki minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'role.required' => 'Peran wajib diisi.',
            'role.string' => 'Peran harus berupa teks.',
            'role.in' => 'Peran harus salah satu dari: tukang, pelanggan.',
            'worker_type_id.required_if' => 'Jenis pekerja wajib diisi untuk peran tukang.',
            'worker_type_id.exists' => 'Jenis pekerja yang dipilih tidak valid.',
            'service_area.required_if' => 'Area layanan wajib diisi untuk peran tukang.',
            'service_area.string' => 'Area layanan harus berupa teks.',
            'experience_years.required_if' => 'Tahun pengalaman wajib diisi untuk peran tukang.',
            'experience_years.integer' => 'Tahun pengalaman harus berupa angka.',
            'experience_years.min' => 'Tahun pengalaman tidak boleh kurang dari 0.',
            'description.string' => 'Deskripsi harus berupa teks.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        if ($user->role === 'tukang') {
            Worker::create([
                'user_id' => $user->id,
                'worker_type_id' => $validated['worker_type_id'],
                'service_area' => $validated['service_area'],
                'experience_years' => $validated['experience_years'],
                'description' => $validated['description'] ?? null,
            ]);
        }

        Auth::login($user);

        return $this->redirectUser($user);
    }

    private function redirectUser(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'tukang') {
            return redirect()->route('tukang.dashboard');
        }

        if ($user->role === 'pelanggan') {
            return redirect()->route('pelanggan.dashboard');
        }

        return redirect()->route('dashboard');
    }
}
