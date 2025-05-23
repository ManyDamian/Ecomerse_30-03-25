<x-app-layout>
    @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
        <h1>Editar Producto</h1>
        <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
            @csrf
            @method('PUT')
            
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
            </div>
            
            <div>
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>
            
            <div>
                <label for="precio">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio', $producto->precio) }}" required>
            </div>
            
            <div>
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $producto->stock) }}" required>
            </div>
            
            <div>
                <label>Imágenes actuales</label>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    @foreach ($producto->imagenes ?? [] as $index => $img)
                        <div style="position: relative;">
                            <img src="{{ asset('storage/' . $img) }}" alt="Imagen del producto" width="80" height="80" style="object-fit: cover; border-radius: 4px;">
                            <label style="position: absolute; top: 0; right: 0; background: rgba(255,0,0,0.7); color: white; cursor: pointer; padding: 2px 6px; font-size: 12px; border-radius: 0 4px 0 4px;">
                                <input type="checkbox" name="imagenes_a_borrar[]" value="{{ $img }}" style="display:none;">
                                ✕
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div>
                <label for="imagenes">Agregar nuevas imágenes</label>
                <input type="file" name="imagenes[]" id="imagenes" multiple>
            </div>
            <div>
                <label for="categorias">Categorías</label>
                <select name="categorias[]" id="categorias" multiple class="form-control">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ $producto->categorias->contains($categoria->id) ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Usa Ctrl (o Cmd) para seleccionar varias categorías.</small>
            </div>
            <button type="submit">Actualizar</button>
        </form>
    @else 
        <h2 class="text-xl font-semibold mb-4">No puedes estar aquí.</h2>
    @endif
</x-app-layout>
