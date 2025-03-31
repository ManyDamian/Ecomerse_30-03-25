<x-app-layout>
    <h1>Nuevo Producto</h1>
    <form action="{{ route('productos.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
        @csrf
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>
        <div>
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" required></textarea>
        </div>
        <div>
            <label for="precio">Precio</label>
            <input type="number" step="0.01" name="precio" id="precio" required>
        </div>
        <div>
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" required>
        </div>
        <button type="submit">Guardar</button>
    </form>
</x-app-layout>
