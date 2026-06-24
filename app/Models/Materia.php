<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'materias';
    /* Especificamos el nombre de las columnas en la base de datos
    que se pueden asignar masivamente (mass assignment)*/
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Atributos virtuales para compatibilidad con las vistas existentes.
    /*public function getNameAttribute()
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
    */
    public function students()
    {
        return $this->belongsToMany(User::class, 'materia_student', 'materia_id', 'student_id')->withPivot('teacher_id')->withTimestamps();
    }

        public function horarios() {
            return $this->hasMany(Schedule::class);
        }
        public function teachers() {
            // Es el espejo del anterior
            return $this->belongsToMany(Teacher::class, 'materia_teacher', 'materia_id', 'teacher_id');
        }
        public function notas() {
            return $this->hasMany(Nota::class);
        }
}

