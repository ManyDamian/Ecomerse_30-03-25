<x-app-layout>
    <div class="container mt-5">
        <h2 class="text-primary">Editar Categoría</h2>
        <form method="POST" action="{{ route('categorias.update', $categoria->id) }}">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div class="mb-3">
                <x-input-label for="nombre" :value="__('Nombre')" />
                <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" required autofocus />
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <x-input-label for="descripcion" :value="__('Descripción')" />
                <x-text-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" value="{{ old('descripcion', $categoria->descripcion) }}" required />
                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Actualizar Categoría') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
