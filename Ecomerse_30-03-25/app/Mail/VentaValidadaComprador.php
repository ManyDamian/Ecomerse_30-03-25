<?php
// app/Mail/VentaValidadaComprador.php

namespace App\Mail;

use App\Models\Venta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VentaValidadaComprador extends Mailable
{
    use Queueable, SerializesModels;

    public $venta;

    public function __construct(Venta $venta)
    {
        $this->venta = $venta;
    }

    public function build()
    {
        return $this->subject('Compra validada')
                    ->view('emails.venta_validada_comprador');
    }
}
