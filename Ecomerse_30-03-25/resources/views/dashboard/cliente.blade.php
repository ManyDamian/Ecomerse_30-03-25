<x-app-layout>
    @if(auth()->user()->role === 'cliente')
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-3xl font-bold text-center text-black-700 mb-10">Panel de Cliente</h2>
            <p class="text-center mb-8 text-gray-700">Bienvenido, {{ auth()->user()->name }}.</p>

            <div class="flex justify-center gap-6">
                <a href="{{ route('productos.index') }}"
                   class="flex flex-col items-center justify-center w-48 h-24 bg-yellow-200 hover:bg-yellow-300 text-black font-bold rounded-xl shadow-lg transition">
                    <i class="fas fa-boxes text-2xl mb-2"></i>
                    Ver Productos
                </a>
            </div>
        </div>
    @else
        <div class="container mx-auto mt-10 text-center">
            <h2 class="text-xl font-semibold text-red-600">No puedes estar aquí.</h2>
        </div>
    @endif
</x-app-layout>
