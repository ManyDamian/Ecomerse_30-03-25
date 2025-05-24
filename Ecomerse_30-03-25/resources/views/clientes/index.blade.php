<x-app-layout>
    @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
        <div class="max-w-7xl mx-auto mt-10 px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h2 class="text-2xl font-bold text-black-700 flex items-center gap-2">
                    <i class="fas fa-users"></i> Lista de Clientes
                </h2>

                <a href="{{ route('clientes.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-blcak text-sm font-medium rounded shadow">
                    <i class="fas fa-user-plus mr-2"></i> Crear Cliente
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 text-sm px-4 py-3 rounded shadow mb-4 flex items-center gap-2">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($clientes->isEmpty())
                <div class="bg-blue-100 text-blue-800 text-sm text-center px-4 py-3 rounded shadow flex items-center justify-center gap-2">
                    <i class="fas fa-info-circle"></i> No hay clientes registrados.
                </div>
            @else
                <div class="w-full bg-white shadow rounded-lg overflow-x-auto">
                    <table class="w-full table-auto divide-y divide-gray-200">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold">ID</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold">Nombre</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold">Email</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold">Subrol</th>
                                <th class="px-4 py-2 text-center text-sm font-semibold">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm">
                            @foreach ($clientes as $cliente)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $cliente->id }}</td>
                                    <td class="px-4 py-2">{{ $cliente->name }}</td>
                                    <td class="px-4 py-2">{{ $cliente->email }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($cliente->subrol) }}</td>
                                    <td class="px-4 py-2 text-center space-x-2">
                                        <a href="{{ route('clientes.edit', $cliente->id) }}"
                                           class="inline-flex items-center px-2 py-1 bg-yellow-400 hover:bg-yellow-500 text-black text-xs font-semibold rounded shadow">
                                            <i class="fas fa-edit mr-1"></i> Editar
                                        </a>

                                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST"
                                              class="inline-block" onsubmit="return confirm('¿Estás seguro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-2 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded shadow">
                                                <i class="fas fa-trash-alt mr-1"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    @else
        <div class="max-w-2xl mx-auto mt-10 px-4">
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded shadow text-center">
                <i class="fas fa-ban mr-2"></i> No puedes estar aquí.
            </div>
        </div>
    @endif
</x-app-layout>
