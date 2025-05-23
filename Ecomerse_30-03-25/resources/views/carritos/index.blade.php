<x-app-layout>
    <div class="container mt-5">
        <h2 class="text-primary mb-4">Lista de Carritos</h2>

        @if($carritos->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> No hay carritos registrados.
            </div>
        @else
            <form action="{{ route('ventas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <table class="table table-hover table-bordered shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carritos as $carrito)
                            <tr>
                                <td>{{ $carrito->id }}</td>
                                <td>{{ $carrito->user->name }}</td>
                                <td>{{ $carrito->producto->nombre }}</td>
                                <td>{{ $carrito->cantidad }}</td>

                                {{-- Inputs ocultos para enviar productos --}}
                                <input type="hidden" name="productos[{{ $loop->index }}][id]" value="{{ $carrito->producto->id }}">
                                <input type="hidden" name="productos[{{ $loop->index }}][cantidad]" value="{{ $carrito->cantidad }}">
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    <div class="mb-3">
                    <a href="{{ route('productos.index') }}" class="btn btn-success">
                    <i class="fas fa-plus-circle"></i> Agregar más Productos
                    </a>
                </div>

                <div class="mb-3">
                    <label for="ticket" class="form-label">Subir ticket bancario (imagen):</label>
                    <input type="file" name="ticket" id="ticket" class="form-control" required>
                    @error('ticket')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-shopping-cart"></i> Finalizar Compra
                </button>
            </form>
        @endif
    </div>
</x-app-layout>
