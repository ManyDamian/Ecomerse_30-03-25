<x-app-layout>
    <div class="max-w-7xl mx-auto mt-10 px-4">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <h2 class="text-2xl font-bold text-black-700 flex items-center gap-2">
                <i class="fas fa-tags"></i> Lista de Categorías
            </h2>

            @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
                <a href="{{ route('categorias.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-black text-sm font-medium rounded shadow">
                    <i class="fas fa-plus-circle mr-2"></i> Crear Categoría
                </a>
            @endif
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($categorias->isEmpty())
            <div class="bg-blue-100 text-blue-800 text-sm text-center px-4 py-3 rounded shadow flex items-center justify-center gap-2">
                <i class="fas fa-info-circle"></i> No hay categorías registradas.
            </div>
        @else
            <div class="w-full bg-white shadow rounded-lg overflow-x-auto">
                <table class="w-full table-auto divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left font-semibold">ID</th>
                            <th class="px-4 py-2 text-left font-semibold">Nombre</th>
                            <th class="px-4 py-2 text-left font-semibold">Descripción</th>
                            @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
                                <th class="px-4 py-2 text-center font-semibold">Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-800">
                        @foreach ($categorias as $categoria)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $categoria->id }}</td>
                                <td class="px-4 py-2">{{ $categoria->nombre }}</td>
                                <td class="px-4 py-2">{{ $categoria->descripcion }}</td>
                                @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
                                    <td class="px-4 py-2 text-center space-x-2 whitespace-nowrap">
                                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="inline-flex items-center px-2 py-1 bg-yellow-400 hover:bg-yellow-500 text-black text-xs font-semibold rounded shadow">
                                            <i class="fas fa-edit mr-1"></i> Editar
                                        </a>
                                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">
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
