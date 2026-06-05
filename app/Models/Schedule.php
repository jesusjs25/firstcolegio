<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'materia_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    // Esto ayuda a Laravel a manejar los tiempos automáticamente
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
}