<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <!-- Sección: Título -->
        <h2 class="text-3xl font-bold text-black-800 mb-8 flex items-center gap-2">
            <i class="fas fa-chart-bar"></i> Dashboard Administrativo
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Columna 1, fila 1: Usuarios registrados -->
            <div class="bg-white shadow rounded p-6 border-t-4 border-blue-600">
                <h4 class="text-lg font-semibold text-black-700 mb-4">Usuarios registrados</h4>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-sm text-gray-600">Total</p>
                        <p class="text-2xl font-bold text-blue-700">{{ $totalUsuarios }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Vendedores</p>
                        <p class="text-2xl font-bold text-green-700">{{ $vendedores }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Compradores</p>
                        <p class="text-2xl font-bold text-cyan-700">{{ $compradores }}</p>
                    </div>
                </div>
            </div>

            <!-- Columna 2, fila 1: Productos por Categoría -->
            <div class="bg-white shadow rounded p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-boxes text-gray-600"></i> Productos por Categoría
                </h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left p-2 border-b">Categoría</th>
                                <th class="text-left p-2 border-b">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoriasConConteo as $categoria)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-2 border-b">{{ $categoria->nombre }}</td>
                                    <td class="p-2 border-b">{{ $categoria->productos_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Columna 1, fila 2: Producto Más Vendido -->
            <div class="bg-white shadow rounded p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-star text-yellow-500"></i> Producto Más Vendido
                </h4>
                @if ($productoMasVendido)
                    <div class="bg-green-100 text-green-800 p-4 rounded">
                        <strong>{{ $productoMasVendido->nombre }}</strong> con <strong>{{ $productoMasVendido->total_vendido }}</strong> unidades vendidas.
                    </div>
                @else
                    <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
                        No hay productos vendidos aún.
                    </div>
                @endif
            </div>

            <!-- Columna 2, fila 2: Comprador más frecuente por Categoría -->
            <div class="bg-white shadow rounded p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-user-tag text-purple-600"></i> Comprador más frecuente por Categoría
                </h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left p-2 border-b">Categoría</th>
                                <th class="text-left p-2 border-b">Comprador</th>
                                <th class="text-left p-2 border-b">Compras</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($compradoresFrecuentes as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-2 border-b">{{ $item['categoria'] }}</td>
                                    <td class="p-2 border-b">{{ $item['comprador'] }}</td>
                                    <td class="p-2 border-b">{{ $item['compras'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center p-2 text-gray-500">No hay compras registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-center text-sm text-gray-400 mt-10">
            Última actualización: {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>
</x-app-layout>
