<x-app-layout>
    @if(auth()->user()->role === 'gerente' || auth()->user()->role === 'empleado')
        <div class="flex justify-center mt-10 px-4">
            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" class="flex flex-col gap-4 max-w-xl w-full bg-white p-6 rounded shadow">
                <h1 class="text-2xl font-bold mb-4 text-center text-black-600">Editar Cliente</h1>

                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">¡Ups!</strong>
                        <span class="block sm:inline">Revisa los siguientes errores:</span>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label for="name" class="block font-semibold mb-1">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $cliente->name) }}" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label for="email" class="block font-semibold mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $cliente->email) }}" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label for="subrol" class="block font-semibold mb-1">Subrol</label>
                    <select name="subrol" id="subrol" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="comprador" {{ (old('subrol', $cliente->subrol) === 'comprador') ? 'selected' : '' }}>Comprador</option>
                        <option value="vendedor" {{ (old('subrol', $cliente->subrol) === 'vendedor') ? 'selected' : '' }}>Vendedor</option>
                    </select>
                </div>

                <div class="flex justify-between mt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black font-semibold px-5 py-2 rounded flex items-center gap-2">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>

                    <a href="{{ route('clientes.index') }}" class="border border-gray-400 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </form>
        </div>
    @else
        <div class="mt-10 text-center">
            <h2 class="text-xl font-semibold mb-4">No puedes estar aquí.</h2>
        </div>
    @endif
</x-app-layout>
