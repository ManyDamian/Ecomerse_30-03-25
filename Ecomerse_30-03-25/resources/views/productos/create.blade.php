<x-app-layout>
    @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado' || auth()->user()->subrol === 'vendedor')
        <h1>Nuevo Producto</h1>
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
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
            <div>
                <label for="imagenes">Imágenes</label>
                <input type="file" name="imagenes[]" id="imagenes" multiple required>
            </div>
            <button type="submit">Guardar</button>
        </form>
    @else 
        <h2 class="text-xl font-semibold mb-4">No puedes estar aquí.</h2>
    @endif
</x-app-layout>
