<x-app-layout>
    <div class="container mx-auto mt-8 px-4 max-w-lg">
        <h2 class="mb-6 text-2xl font-semibold text-blue-600 text-center">Crear Nueva Categoría</h2>

        <form method="POST" action="{{ route('categorias.store') }}" class="bg-white shadow rounded-lg p-6 space-y-4">
            @csrf

            <div>
                <label for="nombre" class="block text-gray-700 font-medium mb-1">Nombre</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    required
                    autofocus
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>

            <div>
                <label for="descripcion" class="block text-gray-700 font-medium mb-1">Descripción</label>
                <input
                    type="text"
                    id="descripcion"
                    name="descripcion"
                    value="{{ old('descripcion') }}"
                    required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
            </div>

            <div class="flex justify-between items-center mt-6">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-black font-semibold px-5 py-2 rounded flex items-center gap-2"
                >
                    <i class="fas fa-save"></i> Crear Categoría
                </button>

                <a href="{{ route('categorias.index') }}"
                    class="border border-gray-400 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded flex items-center gap-2"
                >
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
