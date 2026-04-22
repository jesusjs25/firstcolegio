<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /*
     *Especificamos el nombre de las columnas en la base de datos
    que se pueden asignar masivamente (mass assignment)

     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'teacher_id',
    ];

    /**
     * Los atributos que deben ocultarse durante la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
