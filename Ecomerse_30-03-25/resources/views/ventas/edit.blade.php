<x-app-layout>
    @if(auth()->user()->role === 'gerente')
        <div class="flex justify-center mt-10 px-4">
            <form action="{{ route('ventas.update', $venta->id) }}" method="POST" class="flex flex-col gap-4 max-w-xl w-full bg-white p-6 rounded shadow">
                <h1 class="text-2xl font-bold mb-4 text-center text-black-600">Editar Venta</h1>

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
                    <label for="id" class="block font-semibold mb-1">ID de la Venta</label>
                    <input
                        type="text"
                        id="id"
                        class="w-full border rounded px-3 py-2 bg-gray-100 cursor-not-allowed"
                        value="{{ $venta->id }}"
                        readonly
                    >
                </div>

                <div>
                    <label for="user" class="block font-semibold mb-1">Comprador</label>
                    <input
                        type="text"
                        id="user"
                        class="w-full border rounded px-3 py-2 bg-gray-100 cursor-not-allowed"
                        value="{{ $venta->usuario->name }}"
                        readonly
                    >
                </div>

                <div>
                    <label for="total" class="block font-semibold mb-1">Total</label>
                    <input
                        type="text"
                        id="total"
                        class="w-full border rounded px-3 py-2 bg-gray-100 cursor-not-allowed"
                        value="${{ number_format($venta->total, 2) }}"
                        readonly
                    >
                </div>

                <div>
                    <label for="estado" class="block font-semibold mb-1">Estado</label>
                    <select
                        name="estado"
                        id="estado"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                        <option value="pendiente" {{ $venta->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="validada" {{ $venta->estado == 'validada' ? 'selected' : '' }}>Validada</option>
                    </select>
                </div>

                <div class="flex justify-between mt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black font-semibold px-5 py-2 rounded flex items-center gap-2">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>

                    <a href="{{ route('ventas.index') }}" class="border border-gray-400 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded flex items-center gap-2">
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
