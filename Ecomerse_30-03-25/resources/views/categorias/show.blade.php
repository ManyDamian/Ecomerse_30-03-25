<x-app-layout>
    <div class="container mt-5">
        <h2 class="text-primary">Detalles de la Categoría</h2>
        
        <div class="mb-3">
            <strong>Nombre:</strong> {{ $categoria->nombre }}
        </div>

        <div class="mb-3">
            <strong>Descripción:</strong> {{ $categoria->descripcion }}
        </div>

        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Volver a la lista</a>
    </div>
</x-app-layout>
