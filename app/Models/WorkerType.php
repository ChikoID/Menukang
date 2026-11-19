<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'description'])]
class WorkerType extends Model
{
    use HasFactory, Notifiable;

    /**
     * @return HasMany<Worker, $this>
     */
    public function workers(): HasMany
    {
        return $this->hasMany(Worker::class);
    }
}
