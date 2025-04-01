<x-app-layout>
    
    @if(auth()->user()->role === 'gerente')
        <h2 class="text-xl font-semibold mb-4">Panel de Gerente</h2>
        <p class="mb-4">Bienvenido, gerente.</p>
        <div class="mb-4">
            <a href="{{ route('empleados.index') }}" class="btn btn-primary">Gestión de Empleados</a>
        </div>

        <div class="mb-4">
            <a href="{{ route('clientes.index') }}" class="btn btn-primary">Gestión de Clientes</a>
        </div>

        <div class="mb-4">
            <a href="{{ route('productos.index') }}" class="btn btn-primary">Gestión de Productos</a>
        </div>
    @else
        <h2 class="text-xl font-semibold mb-4">No puedes estar aquí.</h2>
    @endif
</x-app-layout>
