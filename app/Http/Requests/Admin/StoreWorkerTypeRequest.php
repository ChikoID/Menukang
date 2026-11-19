<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWorkerTypeRequest extends FormRequest
{
    /**
     * Access is already restricted to admins by the `roles:admin` route middleware.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('worker_types', 'name')],
            'description' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama jenis tukang wajib diisi.',
            'name.max' => 'Nama jenis tukang tidak boleh lebih dari 255 karakter.',
            'name.unique' => 'Nama jenis tukang sudah ada.',
            'description.string' => 'Deskripsi harus berupa teks.',
        ];
    }
}
