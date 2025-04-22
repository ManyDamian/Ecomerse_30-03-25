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

}
