<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'teachers_id',
    ];

    // Atributos virtuales para compatibilidad con las vistas existentes.
    public function getNameAttribute()
    {
        return $this->attributes['nombre'] ?? null;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['nombre'] = $value;
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['descripcion'] ?? null;
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['descripcion'] = $value;
    }

    public function getTeacherIdAttribute()
    {
        return $this->attributes['teachers_id'] ?? null;
    }

    public function setTeacherIdAttribute($value)
    {
        $this->attributes['teachers_id'] = $value;
    }

    public function profesor()
    {
        return $this->belongsTo(User::class, 'teachers_id');
    }

    public function estudiantes()
    {
        return $this->belongsToMany(User::class, 'materia_student', 'materia_id', 'student_id');
    }
}

