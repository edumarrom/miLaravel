@csrf
<div class="mb-6">
    <label for="nombre"
    class="text-sm font-medium text-gray-900 block mb-2 @error('nombre') text-red-500 @enderror">Nombre</label>
    <input type="text" id="nombre" name="nombre"
        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nombre') border-red-500 @enderror"
        value = "{{ old('nombre', $empleado->nombre) }}">
    @error('nombre')
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="mb-6">
    <label for="fecha_alt"
    class="text-sm font-medium text-gray-900 block mb-2 @error('fecha_alt') text-red-500 @enderror">Fecha de alta</label>
    <input type="text" id="fecha_alt" name="fecha_alt"
        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('fecha_alt') border-red-500 @enderror"
        value = "{{ old('fecha_alt', $empleado->fecha_alt) }}" >
    @error('fecha_alt')
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="mb-6">
    <label for="salario"
    class="text-sm font-medium text-gray-900 block mb-2 @error('salario') text-red-500 @enderror">Salario</label>
    <input type="text" id="salario" name="salario"
        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('salario') border-red-500 @enderror"
        value = "{{ old('salario', $empleado->salario) }}">
    @error('salario')
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</div>
<div class="mb-6">
    <label for="depart_id"
    class="text-sm font-medium text-gray-900 block mb-2 @error('depart_id') text-red-500 @enderror">ID Departamento</label>
    <input type="text" id="depart_id" name="depart_id"
        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('depart_id') border-red-500 @enderror"
        value = "{{ old('depart_id', $empleado->depart_id) }}">
    @error('depart_id')
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</div>

<button type="submit"
    class="text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:ring-green-200
    font-medium rounded-lg text-sm px-5 py-2.5 text-center">Enviar</button>
<button
    class="text-white bg-gray-400 hover:bg-gray-500 focus:ring-4 focus:ring-gray-200
    font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    <a href="/emple">Volver</a>
</button>
