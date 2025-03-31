<x-app-layout>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold">Lista de Empleados</h2>
            <a href="{{ route('empleados.create') }}" class="btn btn-success shadow">
                <i class="fas fa-user-plus"></i> Crear Empleado
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Éxito:</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($empleados->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> No hay empleados registrados.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered shadow-sm rounded">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleados as $empleado)
                            <tr>
                                <td class="align-middle text-center">{{ $empleado->id }}</td>
                                <td class="align-middle">{{ $empleado->name }}</td>
                                <td class="align-middle">{{ $empleado->email }}</td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-warning btn-sm shadow-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('¿Estás seguro?')">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>