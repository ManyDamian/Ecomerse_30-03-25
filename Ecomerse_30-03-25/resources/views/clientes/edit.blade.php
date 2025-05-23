<x-app-layout>
    @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
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

            <div>
                <label for="subrol">Subrol</label>
                <select name="subrol" id="subrol" required>
                    <option value="comprador" {{ $cliente->subrol === 'comprador' ? 'selected' : '' }}>Comprador</option>
                    <option value="vendedor" {{ $cliente->subrol === 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                </select>
            </div>

            <button type="submit">Actualizar</button>
        </form>
    @else 
        <h2 class="text-xl font-semibold mb-4">No puedes estar aquí.</h2>
    @endif
</x-app-layout>
