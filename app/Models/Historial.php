<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $table = 'historiales';

    protected $fillable = [
        // Agrega aquí los campos que deseas permitir para asignación masiva
    ];
}