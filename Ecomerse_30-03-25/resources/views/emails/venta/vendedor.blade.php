@component('mail::message')
# Venta Validada

Hola {{ $producto->vendedor->name }},

Tu producto "{{ $producto->nombre }}" ha sido vendido.

Detalles de la venta:

- ID Venta: {{ $venta->id }}
- Cantidad vendida: {{ $producto->pivot->cantidad }}
- Total venta: ${{ number_format($venta->total, 2) }}

Por favor, prepara el envío.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
