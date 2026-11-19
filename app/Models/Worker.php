<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

#[Fillable(['user_id', 'worker_type_id', 'service_area', 'experience_years', 'description', 'status'])]
class Worker extends Model
{
    use HasFactory, Notifiable;

    protected $casts = [
        'experience_years' => 'integer',
        'status' => 'string',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<WorkerType, $this>
     */
    public function workerType(): BelongsTo
    {
        return $this->belongsTo(WorkerType::class);
    }
}
