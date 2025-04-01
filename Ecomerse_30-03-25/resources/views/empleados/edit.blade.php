<x-app-layout>
    <div class="container">
        @if(auth()->user()->role === 'gerente')
            <h2>Editar Empleado</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $empleado->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $empleado->email }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>

            <a href="{{ route('empleados.index') }}" class="btn btn-secondary mt-3">Volver</a>
        </div>
    
        @else 
            <h2 class="text-xl font-semibold mb-4">No puedes estar aquí.</h2>
        @endif
</x-app-layout>
