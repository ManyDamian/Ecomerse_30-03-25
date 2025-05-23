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
                <table class="table table-hover table-bordered shadow-sm align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Imágenes</th>
                            <th>Categorías</th>
                            @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
                                <th>Vendedor</th>
                            @endif
                            @if(auth()->user()->role === 'cliente')
                                <th class="text-center">Agregar al carrito</th>
                            @endif
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
                                <td>{{ number_format($producto->precio, 2) }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>
                                    @if(is_array($producto->imagenes) && count($producto->imagenes) > 0)
                                        @foreach($producto->imagenes as $img)
                                            <img src="{{ asset('storage/' . $img) }}" alt="Imagen del producto" width="60" height="60" class="me-1 mb-1 rounded" style="object-fit: cover;">
                                        @endforeach
                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>
                                <td>
                                    @forelse ($producto->categorias as $categoria)
                                        <span class="badge bg-primary">{{ $categoria->nombre }}</span>
                                    @empty
                                        <span class="text-muted">Sin categoría</span>
                                    @endforelse
                                </td>

                                @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
                                    <td>{{ $producto->vendedor->name ?? 'Desconocido' }}</td>
                                @endif
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
                                @if(auth()->user()->role === 'cliente')
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('carritos.store') }}" class="d-flex justify-content-center align-items-center">
                                            @csrf
                                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                            <input type="number" name="cantidad" value="1" min="1" class="form-control w-25 me-2" />
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-cart-plus"></i> Agregar
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
