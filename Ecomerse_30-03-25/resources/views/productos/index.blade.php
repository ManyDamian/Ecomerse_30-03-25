<x-app-layout>
    <div class="max-w-7xl mx-auto mt-10 px-4">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <h2 class="text-2xl font-bold text-black-700 flex items-center gap-2">
                <i class="fas fa-box-open"></i> Lista de Productos
            </h2>

            @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado' || auth()->user()->subrol === 'vendedor')
                <a href="{{ route('productos.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-black text-sm font-medium rounded shadow">
                    <i class="fas fa-plus-circle mr-2"></i> Crear Producto
                </a>
            @endif
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($productos->isEmpty())
            <div class="bg-blue-100 text-blue-800 text-sm text-center px-4 py-3 rounded shadow flex items-center justify-center gap-2">
                <i class="fas fa-info-circle"></i> No hay productos registrados.
            </div>
        @else
            <div class="w-full bg-white shadow rounded-lg overflow-x-auto">
                <table class="w-full table-auto divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left font-semibold">ID</th>
                            <th class="px-4 py-2 text-left font-semibold">Nombre</th>
                            <th class="px-4 py-2 text-left font-semibold">Descripción</th>
                            <th class="px-4 py-2 text-left font-semibold">Precio</th>
                            <th class="px-4 py-2 text-left font-semibold">Stock</th>
                            <th class="px-4 py-2 text-left font-semibold">Imágenes</th>
                            <th class="px-4 py-2 text-left font-semibold">Categorías</th>
                            @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
                                <th class="px-4 py-2 text-left font-semibold">Vendedor</th>
                            @endif
                            @if(auth()->user()->role === 'cliente')
                                <th class="px-4 py-2 text-center font-semibold">Agregar al carrito</th>
                            @endif
                            @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado' || auth()->user()->subrol === 'vendedor')
                                <th class="px-4 py-2 text-center font-semibold">Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-800">
                        @foreach ($productos as $producto)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $producto->id }}</td>
                                <td class="px-4 py-2">{{ $producto->nombre }}</td>
                                <td class="px-4 py-2">{{ $producto->descripcion }}</td>
                                <td class="px-4 py-2">${{ number_format($producto->precio, 2) }}</td>
                                <td class="px-4 py-2">{{ $producto->stock }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex gap-2 flex-wrap">
                                        @if(is_array($producto->imagenes) && count($producto->imagenes) > 0)
                                            @foreach($producto->imagenes as $img)
                                                <img src="{{ asset('storage/' . $img) }}" class="w-14 h-14 object-cover rounded" alt="Imagen del producto">
                                            @endforeach
                                        @else
                                            <span class="text-gray-500 italic">Sin imagen</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    @forelse ($producto->categorias as $categoria)
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">{{ $categoria->nombre }}</span>
                                    @empty
                                        <span class="text-gray-500 italic">Sin categoría</span>
                                    @endforelse
                                </td>
                                @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
                                    <td class="px-4 py-2">{{ $producto->vendedor->name ?? 'Desconocido' }}</td>
                                @endif
                                @if(auth()->user()->role === 'cliente')
                                    <td class="px-4 py-2 text-center">
                                        <form method="POST" action="{{ route('carritos.store') }}" class="flex justify-center items-center gap-2">
                                            @csrf
                                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                            <input type="number" name="cantidad" value="1" min="1" class="w-16 border rounded px-2 py-1 text-sm" />
                                            <button type="submit" class="bg-blue-600 text-black px-3 py-1 rounded hover:bg-blue-700 text-sm">Agregar</button>
                                        </form>
                                    </td>
                                @endif
                                @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado' || auth()->user()->subrol === 'vendedor')
                                    <td class="px-4 py-2 text-center space-x-2 whitespace-nowrap">
                                        <a href="{{ route('productos.edit', $producto->id) }}" class="inline-flex items-center px-2 py-1 bg-yellow-400 hover:bg-yellow-500 text-black text-xs font-semibold rounded shadow">
                                            <i class="fas fa-edit mr-1"></i> Editar
                                        </a>
                                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-2 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded shadow">
                                                <i class="fas fa-trash-alt mr-1"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
