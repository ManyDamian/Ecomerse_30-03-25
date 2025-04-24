<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Categoria extends Model
{
    use HasFactory;

    // Añadir los campos que deseas permitir para asignación masiva
    protected $fillable = [
        'nombre', 
        'descripcion'
    ];
}
