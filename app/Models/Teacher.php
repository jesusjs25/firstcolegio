<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // Ajustado a las columnas que realmente existen en la tabla Teachers
    protected $fillable = [
        'user_id',
        'specialty',
    ];

    /**
     * Relación: Un Teacher pertenece a un Usuario
     */

    public function user() {
        return $this->belongsTo(User::class);           // Relación con el modelo User
    }
    public function materias() {
        // Laravel buscará la tabla 'materia_teacher'
        // Los campos son 'teacher_id' y 'materia_id'
        return $this->belongsToMany(Materia::class, 'materia_teacher', 'teacher_id', 'materia_id')
        ->withPivot('horario'); // Si quieres acceder al campo 'horario' en la tabla pivote
        
    }
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}

