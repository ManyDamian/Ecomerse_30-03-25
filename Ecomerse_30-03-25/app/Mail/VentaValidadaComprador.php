<?php

namespace App\Mail;

use App\Models\Venta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VentaValidadaComprador extends Mailable
{
    use Queueable, SerializesModels;

    public $venta;
    public $productos;  // colección de productos
    public $vendedor;   // aquí puedes manejar vendedores múltiples si quieres

    public function __construct(Venta $venta)
    {
        $this->venta = $venta;
        $this->productos = $venta->productos; // todos los productos de la venta
        // Si quieres, podrías extraer los vendedores de todos esos productos:
        // $this->vendedores = $this->productos->map->vendedor->unique('id');
    }

    public function build()
    {
        return $this->subject('Tu compra ha sido validada')
                    ->view('emails.venta.comprador')
                    ->with([
                        'venta' => $this->venta,
                        'productos' => $this->productos,
                    ]);
    }
}
