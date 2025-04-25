<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['user_id', 'total', 'fecha', 'estado'];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    // Relación uno a muchos con Producto
    public function productos()
    {
        return $this->hasMany(Producto::class, 'venta_id');
    }
}
