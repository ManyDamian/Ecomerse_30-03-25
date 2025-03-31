<x-app-layout>
    <h1>Nuevo Empleado</h1>
    <form action="{{ route('empleados.store') }}" method="POST" style="display: flex; flex-direction: row; gap: 10px; align-items: center;">
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
</x-app-layout>
