<x-app-layout>
    <h2 class="text-xl font-semibold mb-4">Panel de Gerente</h2>
    <p class="mb-4">Bienvenido, gerente.</p>

    @if(auth()->user()->role === 'gerente')
        <div class="mb-4">
            <a href="{{ route('empleados.index') }}" class="btn btn-primary">Gestión de Empleados</a>
        </div>

        <div class="mb-4">
            <a href="{{ route('clientes.index') }}" class="btn btn-primary">Gestión de Clientes</a>
        </div>

        <div class="mb-4">
            <a href="{{ route('productos.index') }}" class="btn btn-primary">Gestión de Productos</a>
        </div>
    @endif
</x-app-layout>
