<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['usuario_id', 'total', 'fecha', 'estado'];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_venta')->withPivot('cantidad')->withTimestamps();
    }
}
