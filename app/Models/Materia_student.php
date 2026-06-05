<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia_student extends Model
{
    use HasFactory;

    // Si tu tabla se llama 'materia_student', debemos definirla:
    protected $table = 'materia_student';

    protected $fillable = [
        'student_id',
        'materia_id',
        'teacher_id',
    ];

    // Relación con el Alumno
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relación con la Materia
    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    // Relación con el Profesor
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
