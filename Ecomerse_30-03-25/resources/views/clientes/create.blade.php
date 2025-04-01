<x-app-layout>
    @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
        <h1>Nuevo Cliente</h1>
        <form action="{{ route('clientes.store') }}" method="POST" style="display: flex; flex-direction: row; gap: 10px; align-items: center;">
            @csrf

            <div>
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div>
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit">Guardar</button>
        </form>
    @else 
        <h2 class="text-xl font-semibold mb-4">No puedes estar aquí.</h2>
    @endif
</x-app-layout>
