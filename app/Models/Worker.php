<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

#[Fillable(['user_id', 'worker_type_id', 'service_area', 'experience_years', 'description', 'status'])]
class Worker extends Model
{
    use HasFactory, Notifiable;

    protected $casts = [
        'experience_years' => 'integer',
        'status' => 'string',
    ];
}
