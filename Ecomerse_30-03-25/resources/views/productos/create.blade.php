<x-app-layout>
    @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado' || auth()->user()->subrol === 'vendedor')
        <div class="flex justify-center mt-10">
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 max-w-xl w-full bg-white p-6 rounded shadow">
                <h1 class="text-2xl font-bold text-center mb-4">Nuevo Producto</h1>

                @csrf

                <div>
                    <label for="nombre" class="block font-semibold mb-1">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label for="descripcion" class="block font-semibold mb-1">Descripción</label>
                    <textarea name="descripcion" id="descripcion" required rows="4" class="w-full border rounded px-3 py-2"></textarea>
                </div>

                <div>
                    <label for="precio" class="block font-semibold mb-1">Precio</label>
                    <input type="number" step="0.01" name="precio" id="precio" required class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label for="stock" class="block font-semibold mb-1">Stock</label>
                    <input type="number" name="stock" id="stock" required class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label for="imagenes" class="block font-semibold mb-1">Imágenes</label>
                    <input type="file" name="imagenes[]" id="imagenes" multiple required class="w-full">
                <div class="flex justify-between mt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black font-semibold px-5 py-2 rounded flex items-center gap-2">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                    <a href="{{ route('productos.index') }}" class="border border-gray-400 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
        </div>
    @else 
        <h2 class="text-xl font-semibold text-center mt-10">No puedes estar aquí.</h2>
    @endif
</x-app-layout>
