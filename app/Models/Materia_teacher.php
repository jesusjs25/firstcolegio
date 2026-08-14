<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia_teacher extends Model
{
    use HasFactory;

    // Indicamos explícitamente el nombre de la tabla
    protected $table = 'materia_teacher';

    protected $fillable = [
        'teacher_id',
        'materia_id',
        'horario',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
}