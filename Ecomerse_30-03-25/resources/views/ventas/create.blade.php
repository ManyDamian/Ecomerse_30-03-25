<x-app-layout>
    <div class="container mx-auto mt-5 px-4 max-w-lg">
        <h2 class="mb-6 text-2xl font-semibold text-blue-600">Confirmar Compra</h2>

        <form action="{{ route('ventas.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6">
            @csrf

            <table class="w-full border border-gray-300 mb-6 rounded">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-3 py-2 text-left">Producto</th>
                        <th class="border border-gray-300 px-3 py-2 text-center">Cantidad</th>
                        <th class="border border-gray-300 px-3 py-2 text-right">Precio unitario</th>
                        <th class="border border-gray-300 px-3 py-2 text-right">Subtotal</th>
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
                            <td class="border border-gray-300 px-3 py-2">{{ $item->producto->nombre }}</td>
                            <td class="border border-gray-300 px-3 py-2 text-center">{{ $item->cantidad }}</td>
                            <td class="border border-gray-300 px-3 py-2 text-right">${{ number_format($item->producto->precio, 2) }}</td>
                            <td class="border border-gray-300 px-3 py-2 text-right">${{ number_format($subtotal, 2) }}</td>
                        </tr>

                        <!-- Campos ocultos para enviar productos y cantidades -->
                        <input type="hidden" name="productos[{{ $loop->index }}][id]" value="{{ $item->producto->id }}">
                        <input type="hidden" name="productos[{{ $loop->index }}][cantidad]" value="{{ $item->cantidad }}">
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right border border-gray-300 px-3 py-2 font-semibold">Total:</th>
                        <th class="border border-gray-300 px-3 py-2 text-right font-semibold">${{ number_format($total, 2) }}</th>
                    </tr>
                </tfoot>
            </table>

            <div class="mb-6">
                <label for="ticket" class="block text-gray-700 font-medium mb-2">Subir Ticket Bancario</label>
                <input type="file" name="ticket" id="ticket" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded flex items-center gap-2">
                    <i class="fas fa-check"></i> Finalizar Compra
                </button>

                <a href="{{ route('carrito.index') }}" 
                   class="border border-gray-400 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
