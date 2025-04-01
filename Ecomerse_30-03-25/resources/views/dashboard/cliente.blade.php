<x-app-layout>
    @if(auth()->user()->role === 'cliente')
        <h2 class="text-xl font-semibold">Panel de Cliente</h2>
        <p>Bienvenido, cliente.</p>
        <div class="mb-4">
            <a href="{{ route('productos.index') }}" class="btn btn-primary">Productos</a>
        </div>
    @else
        <h2 class="text-xl font-semibold mb-4">No puedes estar aquí.</h2>
    @endif
</x-app-layout>

