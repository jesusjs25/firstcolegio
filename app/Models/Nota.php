<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    //
    protected $fillable = [
        'student_id',
        'materia_id',
        'teacher_id',
        'nombre_nota',
        'valor_nota',
        'fecha_nota',
    ];
    
    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function materia(){
        return $this->belongsTo(Materia::class);
    }
}
