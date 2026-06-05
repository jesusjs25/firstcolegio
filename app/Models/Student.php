<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Ajustado a las columnas que realmente existen en tu tabla
    protected $fillable = [
        'user_id',
        'document',
        'birth_date',
    ];

    /**
     * Relación: Un Estudiante pertenece a un Usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function MateriaStudent()
    {
        return $this->hasMany(Materia_student::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}