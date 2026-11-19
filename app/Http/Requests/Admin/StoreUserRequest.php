<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Access is already restricted to admins by the `roles:admin` route middleware.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Worker profile fields are only kept when the role is "tukang".
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', Rule::in(['admin', 'tukang', 'pelanggan'])],
            'worker_type_id' => ['exclude_unless:role,tukang', 'required', 'integer', Rule::exists('worker_types', 'id')],
            'service_area' => ['exclude_unless:role,tukang', 'required', 'string', 'max:255'],
            'experience_years' => ['exclude_unless:role,tukang', 'required', 'integer', 'min:0'],
            'description' => ['exclude_unless:role,tukang', 'nullable', 'string'],
            'status' => ['exclude_unless:role,tukang', 'nullable', Rule::in(['active', 'inactive'])],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Masukkan alamat email yang valid.',
            'email.max' => 'Alamat email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Alamat email sudah terdaftar.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi harus memiliki minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'role.required' => 'Peran wajib diisi.',
            'role.in' => 'Peran harus salah satu dari: admin, tukang, pelanggan.',
            'worker_type_id.required' => 'Jenis tukang wajib diisi untuk peran tukang.',
            'worker_type_id.exists' => 'Jenis tukang yang dipilih tidak valid.',
            'service_area.required' => 'Area layanan wajib diisi untuk peran tukang.',
            'service_area.max' => 'Area layanan tidak boleh lebih dari 255 karakter.',
            'experience_years.required' => 'Tahun pengalaman wajib diisi untuk peran tukang.',
            'experience_years.integer' => 'Tahun pengalaman harus berupa angka.',
            'experience_years.min' => 'Tahun pengalaman tidak boleh kurang dari 0.',
            'status.in' => 'Status harus active atau inactive.',
        ];
    }
}
