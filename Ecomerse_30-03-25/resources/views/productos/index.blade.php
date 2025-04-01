<x-app-layout>
    <div class="container mt-5">
       
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Lista de Productos</h2>
            @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
                <a href="{{ route('productos.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Crear Producto
                </a>
            @endif
        </div>
        

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($productos->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> No hay productos registrados.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
                            <th class="text-center">Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->descripcion }}</td>
                                <td>{{ $producto->precio }}</td>
                                <td>{{ $producto->stock }}</td>
                                @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
                                <td class="text-center">
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
