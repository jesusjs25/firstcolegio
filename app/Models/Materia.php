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
        'curso',
    ];
    
        public function students()
        {
            // Quitamos ->using(Materia_student::class) para evitar el error de instanciación
            return $this->belongsToMany(Student::class, 'materia_student', 'materia_id', 'student_id')
                        ->withPivot('teacher_id')
                        ->withTimestamps();
        }

        public function horarios() {
            return $this->hasMany(Schedule::class);
        }
        public function teachers() {
            // Es el espejo del anterior
            return $this->belongsToMany(Teacher::class, 'materia_teacher', 'materia_id', 'teacher_id')
                        ->withPivot('horario')
                        ->withTimestamps();
        }
        public function notas() {
            return $this->hasMany(Nota::class);
        }
}

