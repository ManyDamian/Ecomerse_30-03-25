<x-app-layout>
    @if(auth()->user()->role === 'empleado')
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-3xl font-bold text-center text-black-700 mb-10">Panel de Empleado</h2>

            <div class="flex flex-wrap justify-center gap-6">
                <a href="{{ route('clientes.index') }}"
                   class="flex flex-col items-center justify-center w-48 h-24 bg-green-200 hover:bg-green-300 text-black font-bold rounded-xl shadow-lg transition">
                    <i class="fas fa-user-friends text-2xl mb-2"></i>
                    Gestión de Clientes
                </a>

                <a href="{{ route('productos.index') }}"
                   class="flex flex-col items-center justify-center w-48 h-24 bg-yellow-200 hover:bg-yellow-300 text-black font-bold rounded-xl shadow-lg transition">
                    <i class="fas fa-boxes text-2xl mb-2"></i>
                    Gestión de Productos
                </a>
            </div>
        </div>
    @else
        <div class="container mx-auto mt-10 text-center">
            <h2 class="text-xl font-semibold text-red-600">No puedes estar aquí.</h2>
        </div>
    @endif
</x-app-layout>
