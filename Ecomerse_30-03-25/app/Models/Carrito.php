<?php

namespace App\Models;
use App\Models\User;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $fillable = ['user_id','producto_id', 'cantidad'];

    // Relación inversa con Usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
    
}

