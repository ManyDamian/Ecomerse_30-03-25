<x-app-layout>
    <h1>Editar Producto</h1>
    <form action="{{ route('productos.update', $producto->id) }}" method="POST" style="display: flex; flex-direction: row; gap: 10px; align-items: center;">
        @csrf
        @method('PUT')
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ $producto->nombre }}" required>
        </div>
        <div>
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" required></textarea>
        </div>
        <div>
            <label for="precio">Precio</label>
            <input type="number" step="0.01" name="precio" id="precio" value="{{ $producto->precio }}" required>
        </div>
        <div>
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" value="{{ $producto->stock }}" required>
        </div>
        <button type="submit">Actualizar</button>
    </form>
</x-app-layout>
