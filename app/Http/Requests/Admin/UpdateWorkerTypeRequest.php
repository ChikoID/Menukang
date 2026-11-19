<?php

namespace App\Http\Requests\Admin;

use App\Models\WorkerType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class UpdateWorkerTypeRequest extends StoreWorkerTypeRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var WorkerType $workerType */
        $workerType = $this->route('worker_type');

        return [
            ...parent::rules(),
            'name' => ['required', 'string', 'max:255', Rule::unique('worker_types', 'name')->ignore($workerType->id)],
        ];
    }
}
