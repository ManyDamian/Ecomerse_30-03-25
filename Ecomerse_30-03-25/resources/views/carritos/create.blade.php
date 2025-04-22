<x-app-layout>
    <div class="container mt-5">
        <h2 class="text-primary">Crear Nuevo Carrito</h2>
        <form method="POST" action="{{ route('carritos.store') }}">
            @csrf

            <!-- Usuario -->
            <div class="mb-3">
                <x-input-label for="user_id" :value="__('Usuario')" />
                <x-text-input id="user_id" class="block mt-1 w-full" type="number" name="user_id" value="{{ old('user_id') }}" required />
                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
            </div>

            <!-- Producto -->
            <div class="mb-3">
                <x-input-label for="producto_id" :value="__('Producto')" />
                <x-text-input id="producto_id" class="block mt-1 w-full" type="number" name="producto_id" value="{{ old('producto_id') }}" required />
                <x-input-error :messages="$errors->get('producto_id')" class="mt-2" />
            </div>

            <!-- Cantidad -->
            <div class="mb-3">
                <x-input-label for="cantidad" :value="__('Cantidad')" />
                <x-text-input id="cantidad" class="block mt-1 w-full" type="number" name="cantidad" value="{{ old('cantidad') }}" required />
                <x-input-error :messages="$errors->get('cantidad')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Crear Carrito') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
