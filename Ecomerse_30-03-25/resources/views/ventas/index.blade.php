<x-app-layout>
    <div class="max-w-7xl mx-auto mt-10 px-4">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <h2 class="text-2xl font-bold text-black-700 flex items-center gap-2">
                <i class="fas fa-list-alt"></i> Lista de Ventas
            </h2>

            @can('create', App\Models\Venta::class)
                <a href="{{ route('ventas.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded shadow">
                    <i class="fas fa-plus-circle mr-2"></i> Crear Venta
                </a>
            @endcan
        </div>

        @if($ventas->isEmpty())
            <div class="bg-blue-100 text-blue-800 text-sm text-center px-4 py-3 rounded shadow flex items-center justify-center gap-2">
                <i class="fas fa-info-circle"></i> No hay ventas registradas.
            </div>
        @else
            <div class="w-full bg-white shadow rounded-lg">
                <table class="w-full table-auto divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold">ID</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Usuario</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Total</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Estado</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Ticket</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Fecha</th>
                            <th class="px-4 py-2 text-center text-sm font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        @foreach ($ventas as $venta)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $venta->id }}</td>
                                <td class="px-4 py-2">{{ $venta->usuario->name }}</td>
                                <td class="px-4 py-2">${{ number_format($venta->total, 2) }}</td>
                                <td class="px-4 py-2">{{ ucfirst($venta->estado) }}</td>
                                <td class="px-4 py-2">
                                    @if($venta->ticket)
                                        <a href="{{ route('ventas.ticket', $venta->id) }}" target="_blank" class="text-blue-600 hover:underline">Ver ticket</a>
                                    @else
                                        <span class="text-gray-500 italic">Sin ticket</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $venta->created_at->format('d-m-Y') }}</td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    @can('update', $venta)
                                        <a href="{{ route('ventas.edit', $venta->id) }}" class="inline-flex items-center px-2 py-1 bg-yellow-400 hover:bg-yellow-500 text-black text-xs font-semibold rounded shadow">
                                            <i class="fas fa-edit mr-1"></i> Editar
                                        </a>
                                    @endcan

                                    @can('delete', $venta)
                                        <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-2 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded shadow">
                                                <i class="fas fa-trash-alt mr-1"></i> Eliminar
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
