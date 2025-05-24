<x-app-layout>
    @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
        <div class="flex justify-center mt-10">
            <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 max-w-xl w-full bg-white p-6 rounded shadow">
                <h1 class="text-2xl font-bold mb-4 text-center">Editar Producto</h1>
                
                @csrf
                @method('PUT')
                
                <div>
                    <label for="nombre" class="block font-semibold mb-1">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre) }}" required class="w-full border rounded px-3 py-2">
                </div>
                
                <div>
                    <label for="descripcion" class="block font-semibold mb-1">Descripción</label>
                    <textarea name="descripcion" id="descripcion" required class="w-full border rounded px-3 py-2" rows="4">{{ old('descripcion', $producto->descripcion) }}</textarea>
                </div>
                
                <div>
                    <label for="precio" class="block font-semibold mb-1">Precio</label>
                    <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio', $producto->precio) }}" required class="w-full border rounded px-3 py-2">
                </div>
                
                <div>
                    <label for="stock" class="block font-semibold mb-1">Stock</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $producto->stock) }}" required class="w-full border rounded px-3 py-2">
                </div>
                
                <div>
                    <label class="block font-semibold mb-2">Imágenes actuales</label>
                    <div class="flex gap-3 flex-wrap">
                        @foreach ($producto->imagenes ?? [] as $img)
                            <div class="relative inline-block group">
                                <img src="{{ asset('storage/' . $img) }}" alt="Imagen del producto" class="w-20 h-20 object-cover rounded">

                                <button type="button"
                                        onclick="confirmarEliminacion(this)"
                                        class="absolute top-0 right-0 bg-red-600 text-white px-2 py-0.5 text-xs rounded-bl hover:bg-red-700 z-10"
                                        title="Eliminar imagen">
                                    ✕
                                </button>

                                <input type="checkbox" name="imagenes_a_borrar[]" value="{{ $img }}" class="hidden">
                            </div>
                        @endforeach
                    </div>
                </div>
                <script>
                    function confirmarEliminacion(boton) {
                        if (confirm('¿Estás seguro de que deseas eliminar esta imagen?')) {
                            const checkbox = boton.parentElement.querySelector('input[type="checkbox"]');
                            if (checkbox) checkbox.checked = true;
                            boton.parentElement.querySelector('img').classList.add('opacity-50');
                            boton.disabled = true;
                        }
                    }
                </script>

                
                <div>
                    <label for="imagenes" class="block font-semibold mb-1">Agregar nuevas imágenes</label>
                    <input type="file" name="imagenes[]" id="imagenes" multiple class="w-full">
                </div>
                
                <div>
                    <label for="categorias" class="block font-semibold mb-1">Categorías</label>
                    <select name="categorias[]" id="categorias" multiple class="w-full border rounded px-3 py-2">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $producto->categorias->contains($categoria->id) ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-gray-600">Usa Ctrl (o Cmd) para seleccionar varias categorías.</small>
                <div class="flex justify-between mt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black font-semibold px-5 py-2 rounded flex items-center gap-2">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                    <a href="{{ route('productos.index') }}" class="border border-gray-400 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            @else 
                <h2 class="text-xl font-semibold mb-4">No puedes estar aquí.</h2>
            @endif
        </x-app-layout>
