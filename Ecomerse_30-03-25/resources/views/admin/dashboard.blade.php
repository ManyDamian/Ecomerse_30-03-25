<x-app-layout>
    <div class="container mt-5">
        <h2 class="text-primary mb-4"><i class="fas fa-chart-bar"></i> Dashboard Administrativo</h2>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Usuarios registrados</h5>
                        <p class="card-text fs-4">{{ $totalUsuarios }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-success">Vendedores</h5>
                        <p class="card-text fs-4">{{ $vendedores }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-info shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-info">Compradores</h5>
                        <p class="card-text fs-4">{{ $compradores }}</p>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mt-4"><i class="fas fa-boxes"></i> Productos por Categoría</h4>
        <div class="table-responsive mt-2">
            <table class="table table-bordered table-hover align-middle shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Categoría</th>
                        <th>Cantidad de Productos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categoriasConConteo as $categoria)
                        <tr>
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->productos_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h4 class="mt-4"><i class="fas fa-star"></i> Producto Más Vendido</h4>
        @if ($productoMasVendido)
            <div class="alert alert-success">
                <strong>{{ $productoMasVendido->nombre }}</strong> con <strong>{{ $productoMasVendido->total_vendido }}</strong> unidades vendidas.
            </div>
        @else
            <div class="alert alert-warning">
                No hay productos vendidos aún.
            </div>
        @endif

        <h4 class="mt-4"><i class="fas fa-user-tag"></i> Comprador más frecuente por Categoría</h4>
        <div class="table-responsive mt-2">
            <table class="table table-bordered table-hover align-middle shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Categoría</th>
                        <th>Comprador Frecuente</th>
                        <th>Compras Realizadas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($compradoresFrecuentes as $item)
                        <tr>
                            <td>{{ $item['categoria'] }}</td>
                            <td>{{ $item['comprador'] }}</td>
                            <td>{{ $item['compras'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No hay compras registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
