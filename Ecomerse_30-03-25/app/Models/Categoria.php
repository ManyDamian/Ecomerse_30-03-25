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

     public function compradores()
{
    return $this->hasManyThrough(
        \App\Models\User::class, // Final target
        \App\Models\Venta::class, // Intermediario
        'id', // local key en categoria (-> productos)
        'user_id', // foreign key en ventas
        'id', // local key en productos (desde categorias)
        'id' // foreign key en productos
    );
}
     
    public function productos ()
    {
    //relacion muchos a muchos, un producto puede tener muchas categorias y una categoria puede tener muchos productos
    return $this->belongsToMany(Producto::class, 'categoria_producto', 'categoria_id', 'producto_id');
    }
}
