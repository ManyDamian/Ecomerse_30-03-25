<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock'];

    public function carritos()
    {
    return $this->belongsToMany(Carrito::class, 'carrito_producto')->withTimestamps();
    }

    //relacion muchos a muchos con categoria    
    public function categorias()
    {
    return $this->belongsToMany(Categoria::class, 'categoria_producto', 'producto_id', 'categoria_id');
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

}
