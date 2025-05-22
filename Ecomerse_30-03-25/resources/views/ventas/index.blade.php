<x-app-layout>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Lista de Ventas</h2>
            
            @can('create', App\Models\Venta::class)
                <a href="{{ route('ventas.create') }}" class="btn btn-success">
                    <i class="fas fa-plus-circle"></i> Crear Venta
                </a>
            @endcan
        </div>

        @if($ventas->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> No hay ventas registradas.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Ticket</th>
                            <th>Fecha</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                            <tr>
                                <td>{{ $venta->id }}</td>
                                <td>{{ $venta->usuario->name }}</td>
                                <td>${{ number_format($venta->total, 2) }}</td>
                                <td>{{ ucfirst($venta->estado) }}</td>
                                <td>
                                    @if($venta->ticket)
                                    <a href="{{ route('ventas.ticket', $venta->id) }}" target="_blank">Ver ticket</a>
                                @else
                                    Sin ticket
                                @endif
                                
                                </td>
                                <td>{{ $venta->created_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    @can('update', $venta)
                                        <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                    @endcan

                                    @can('delete', $venta)
                                        <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
