<x-app-layout>
    @if(auth()->user()->role === 'gerente')
        <div class="container mx-auto mt-8 px-4 max-w-lg">
            <h2 class="mb-6 text-2xl font-semibold text-blue-600 text-center">Registrar Nuevo Empleado</h2>

            <form action="{{ route('empleados.store') }}" method="POST" class="bg-white shadow rounded-lg p-6 space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-1">Nombre</label>
                    <input type="text" name="name" id="name" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-1">Correo Electrónico</label>
                    <input type="email" name="email" id="email" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-1">Contraseña</label>
                    <input type="password" name="password" id="password" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="flex justify-between items-center mt-6">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-black font-semibold px-5 py-2 rounded flex items-center gap-2">
                        <i class="fas fa-save"></i> Guardar
                    </button>

                    <a href="{{ route('empleados.index') }}"
                        class="border border-gray-400 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </form>
        </div>
    @else
        <div class="container mx-auto mt-10 text-center">
            <h2 class="text-xl font-semibold text-red-600">No puedes estar aquí.</h2>
        </div>
    @endif
</x-app-layout>
