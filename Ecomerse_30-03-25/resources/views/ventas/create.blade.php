<x-app-layout>
    <div class="container mt-5">
        <h2 class="text-primary">Crear Venta</h2>
        <form method="POST" action="{{ route('ventas.store') }}">
            @csrf

            <!-- Productos -->
            <div class="mb-3">
                <x-input-label for="productos" :value="__('Productos')" />
                <div id="productos-seleccionados">
                    @foreach($carritos as $carrito)
                        <div class="mb-2">
                            <label>{{ $carrito->producto->nombre }} ({{ $carrito->cantidad }} disponibles)</label>
                            <input type="number" name="productos[{{ $carrito->producto->id }}][cantidad]" value="1" min="1" max="{{ $carrito->cantidad }}" class="form-control" required>
                            <input type="hidden" name="productos[{{ $carrito->producto->id }}][id]" value="{{ $carrito->producto->id }}">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Crear Venta') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
