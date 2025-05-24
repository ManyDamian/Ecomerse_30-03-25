<x-app-layout>
    @if(auth()->user()->role === 'gerente')
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-3xl font-bold text-center text-black-700 mb-10">Panel de Gerente</h2>

            <div class="flex flex-wrap justify-center gap-6">
                <a href="{{ route('empleados.index') }}"
                   class="flex flex-col items-center justify-center w-48 h-24 bg-blue-200 hover:bg-blue-300 text-black font-bold rounded-xl shadow-lg transition">
                    <i class="fas fa-users-cog text-2xl mb-2"></i>
                    Empleados
                </a>

                <a href="{{ route('clientes.index') }}"
                   class="flex flex-col items-center justify-center w-48 h-24 bg-green-200 hover:bg-green-300 text-black font-bold rounded-xl shadow-lg transition">
                    <i class="fas fa-user-friends text-2xl mb-2"></i>
                    Clientes
                </a>

                <a href="{{ route('productos.index') }}"
                   class="flex flex-col items-center justify-center w-48 h-24 bg-yellow-200 hover:bg-yellow-300 text-black font-bold rounded-xl shadow-lg transition">
                    <i class="fas fa-boxes text-2xl mb-2"></i>
                    Productos
                </a>

                <a href="{{ route('categorias.index') }}"
                   class="flex flex-col items-center justify-center w-48 h-24 bg-pink-200 hover:bg-pink-300 text-black font-bold rounded-xl shadow-lg transition">
                    <i class="fas fa-tags text-2xl mb-2"></i>
                    Categorías
                </a>

                <a href="{{ route('ventas.index') }}"
                   class="flex flex-col items-center justify-center w-48 h-24 bg-purple-200 hover:bg-purple-300 text-black font-bold rounded-xl shadow-lg transition">
                    <i class="fas fa-cash-register text-2xl mb-2"></i>
                    Ventas
                </a>

                <a href="{{ route('estadistica.index') }}"
                   class="flex flex-col items-center justify-center w-48 h-24 bg-indigo-200 hover:bg-indigo-300 text-black font-bold rounded-xl shadow-lg transition">
                    <i class="fas fa-chart-bar text-2xl mb-2"></i>
                    Estadísticas
                </a>
            </div>
        </div>
    @else
        <div class="container mx-auto mt-10 text-center">
            <h2 class="text-xl font-semibold text-red-600">No puedes estar aquí.</h2>
        </div>
    @endif
</x-app-layout>
