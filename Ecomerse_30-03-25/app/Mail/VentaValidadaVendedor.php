<?php

namespace App\Mail;
use App\Models\User;
use App\Models\Producto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VentaValidadaVendedor extends Mailable
{
    use Queueable, SerializesModels;

    public $producto;
    public $vendedor;

    public function __construct(Producto $producto, User $vendedor)
    {
        $this->producto = $producto;
        $this->vendedor = $vendedor;
    }

    public function build()
    {
        return $this->subject('Tu compra ha sido validada')
            ->view('emails.venta_validada_comprador');
    }

    /**
     * Create a new message instance.
     */
    
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Venta Validada Vendedor',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
