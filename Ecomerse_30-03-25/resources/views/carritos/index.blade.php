<x-app-layout>
    <div class="flex justify-center mt-10">
        <form action="{{ route('ventas.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6 max-w-3xl w-full bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold text-center text-black-600">Lista de Carritos</h1>
            @csrf

            @if ($carritos->isEmpty())
                <div class="text-center bg-blue-100 text-blue-700 p-4 rounded">
                    <i class="fas fa-info-circle mr-2"></i> No hay carritos registrados.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 rounded">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-4 py-2 text-left">ID</th>
                                <th class="px-4 py-2 text-left">Usuario</th>
                                <th class="px-4 py-2 text-left">Producto</th>
                                <th class="px-4 py-2 text-left">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carritos as $carrito)
                                <tr class="border-t border-gray-200">
                                    <td class="px-4 py-2">{{ $carrito->id }}</td>
                                    <td class="px-4 py-2">{{ $carrito->user->name }}</td>
                                    <td class="px-4 py-2">{{ $carrito->producto->nombre }}</td>
                                    <td class="px-4 py-2">{{ $carrito->cantidad }}</td>

                                    <!-- Inputs ocultos -->
                                    <input type="hidden" name="productos[{{ $loop->index }}][id]" value="{{ $carrito->producto->id }}">
                                    <input type="hidden" name="productos[{{ $loop->index }}][cantidad]" value="{{ $carrito->cantidad }}">
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-center">
                    <a href="{{ route('productos.index') }}" class="bg-green-600 hover:bg-green-700 text-black font-semibold px-4 py-2 rounded flex items-center gap-2">
                        <i class="fas fa-plus-circle"></i> Agregar más productos
                    </a>
                </div>

                <div>
                    <label for="ticket" class="block font-semibold mb-1">Subir ticket bancario (imagen)</label>
                    <input type="file" name="ticket" id="ticket" required class="w-full border rounded px-3 py-2">
                    @error('ticket')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black font-semibold px-5 py-2 rounded flex items-center gap-2">
                        <i class="fas fa-shopping-cart"></i> Finalizar Compra
                    </button>
                    <a href="{{ route('dashboard') }}" class="border border-gray-400 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </div>
            @endif
        </form>
    </div>
</x-app-layout>
