<x-app-layout>
    <div class="container mt-5">
        <h2>Confirmar Compra</h2>

        <form action="{{ route('ventas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($carritos as $item)
                        @php
                            $subtotal = $item->producto->precio * $item->cantidad;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $item->producto->nombre }}</td>
                            <td>{{ $item->cantidad }}</td>
                            <td>${{ number_format($item->producto->precio, 2) }}</td>
                            <td>${{ number_format($subtotal, 2) }}</td>
                        </tr>

                        <!-- Campos ocultos para enviar productos y cantidades -->
                        <input type="hidden" name="productos[{{ $loop->index }}][id]" value="{{ $item->producto->id }}">
                        <input type="hidden" name="productos[{{ $loop->index }}][cantidad]" value="{{ $item->cantidad }}">
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total:</th>
                        <th>${{ number_format($total, 2) }}</th>
                    </tr>
                </tfoot>
            </table>

            <div class="mb-3">
                <label for="ticket" class="form-label">Subir Ticket Bancario</label>
                <input type="file" name="ticket" id="ticket" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Finalizar Compra</button>
        </form>
    </div>
</x-app-layout>
