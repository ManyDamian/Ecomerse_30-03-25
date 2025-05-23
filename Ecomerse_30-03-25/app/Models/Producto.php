<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;


    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock','user_id','imagenes'];

    protected $casts = ['imagenes' => 'array',];

    

    // Relación con el vendedor (cliente que publica el producto)
    public function vendedor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function ventas()
    {
    return $this->belongsToMany(Venta::class, 'producto_venta');
    }
    
    //relacion muchos a muchos con categoria    
    public function categorias()
    {
    return $this->belongsToMany(Categoria::class, 'categoria_producto', 'producto_id', 'categoria_id');
    }

   

}
