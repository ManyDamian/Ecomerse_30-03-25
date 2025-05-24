<h1>¡Tu producto ha sido vendido!</h1>
<p>Producto: {{ $venta->producto->nombre }}</p>
<p>Debes enviarlo a:</p>
<ul>
    <li>Nombre: {{ $venta->usuario->name }}</li>
    <li>Email: {{ $venta->usuario->email }}</li>
</ul>
