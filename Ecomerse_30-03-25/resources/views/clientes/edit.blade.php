<x-app-layout>
    <h1>Editar Cliente</h1>
    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" style="display: flex; flex-direction: row; gap: 10px; align-items: center;">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" value="{{ $cliente->name }}" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ $cliente->email }}" required>
        </div>

        <button type="submit">Actualizar</button>
    </form>
</x-app-layout>
