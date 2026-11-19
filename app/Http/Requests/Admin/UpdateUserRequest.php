<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateUserRequest extends StoreUserRequest
{
    /**
     * Same rules as creating a user, except the email may stay the same and the password is optional.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var User $user */
        $user = $this->route('user');

        return [
            ...parent::rules(),
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * Prevent admins from removing their own admin access.
     *
     * @return array<int, callable(Validator): void>
     */
    public function after(): array
    {
        return [
            function (Validator $validator): void {
                if ($validator->errors()->has('role')) {
                    return;
                }

                if ($this->route('user')->is($this->user()) && $this->input('role') !== 'admin') {
                    $validator->errors()->add('role', 'Anda tidak dapat mengubah peran akun Anda sendiri.');
                }
            },
        ];
    }
}
