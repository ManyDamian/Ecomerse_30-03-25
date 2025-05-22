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

     // Relación hasManyThrough para llegar a compradores
     public function compradores()
     {
         return $this->hasManyThrough(
             User::class,
             Venta::class,
             'producto_id',  // Foreign key en ventas
             'id',           // Foreign key en users
             'id',           // Local key en categorias -> productos (a través de belongsToMany)
             'user_id'       // Foreign key en ventas
         );
     }
     
    public function productos ()
    {
    //relacion muchos a muchos, un producto puede tener muchas categorias y una categoria puede tener muchos productos
    return $this->belongsToMany(Producto::class, 'categoria_producto', 'categoria_id', 'producto_id');
    }
}
