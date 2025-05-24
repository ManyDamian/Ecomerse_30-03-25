<x-app-layout>
    <div class="container mt-5">
        <h2 class="mb-4 text-primary">Editar Venta</h2>

        <form action="{{ route('ventas.update', $venta->id) }}" method="POST" class="card shadow p-4">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="id" class="form-label">ID de la Venta</label>
                <input type="text" class="form-control" value="{{ $venta->id }}" readonly>
            </div>

            <div class="mb-3">
                <label for="user" class="form-label">Comprador</label>
                <input type="text" class="form-control" value="{{ $venta->usuario->name }}" readonly>
            </div>

            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="text" class="form-control" value="${{ number_format($venta->total, 2) }}" readonly>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado" class="form-select">
                    <option value="pendiente" {{ $venta->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="validada" {{ $venta->estado == 'validada' ? 'selected' : '' }}>Validada</option>
                </select>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar Cambios
                </button>

                <a href="{{ route('ventas.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
