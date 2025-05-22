<x-app-layout>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Lista de Carritos</h2>
            @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
            <a href="{{ route('carritos.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Crear Carrito
            </a>
        @endif
        </div>

        @if($carritos->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> No hay carritos registrados.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carritos as $carrito)
                            <tr>
                                <td>{{ $carrito->id }}</td>
                                <td>{{ $carrito->user->name }}</td>
                                <td>{{ $carrito->producto->nombre }}</td>
                                <td>{{ $carrito->cantidad }}</td>
                                <td class="text-center">
                                    <a href="{{ route('carritos.edit', $carrito->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('carritos.destroy', $carrito->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if(!$carritos->isEmpty())
                        <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">
                            <i class="fas fa-shopping-cart"></i> Comprar
                        </a>
                      @endif
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
