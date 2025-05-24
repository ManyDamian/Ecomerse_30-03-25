<h1>Compra validada</h1>

<p>Hola {{ $venta->comprador->name }},</p>

<p>Tu compra con ID {{ $venta->id }} ha sido validada.</p>

<p>Productos comprados:</p>
<ul>
    @foreach ($productos as $producto)
        <li>{{ $producto->nombre }} - Cantidad: {{ $producto->pivot->cantidad }}</li>
    @endforeach
</ul>

<p>Total: ${{ number_format($venta->total, 2) }}</p>

<p>Gracias por comprar con nosotros.</p>
