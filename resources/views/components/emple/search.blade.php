<div class="w-80">
    <form action="/emple" method="get">
        <input type="hidden" name="orden" value="{{ request()->query('orden') }}">

        <div class="mb-3">
            <label for="nombre"
                class="text-sm font-medium text-gray-900 block mb-2">
                Nombre
            </label>
            <input type="text" name="nombre" id="nombre"
                class="bg-gray-50 border border-gray-300 text-gray-900
                sm:text-sm rounded-1g focus:ring-blue-500 focus:border-blue-500
                block w-full p-1 px-2" value="{{ request()->query('nombre') }}">
        </div>

        <div class="mb-3">
            <label for="fecha_alt"
                class="text-sm font-medium text-gray-900 block mb-2">
                Fecha de alta
            </label>
            <input type="text" name="fecha_alt" id="fecha_alt"
                class="bg-gray-50 border border-gray-300 text-gray-900
                sm:text-sm rounded-1g focus:ring-blue-500 focus:border-blue-500
                block w-full p-1 px-2" value="{{ request()->query('fecha_alt') }}">
        </div>

        <div class="mb-3">
            <label for="salario"
                class="text-sm font-medium text-gray-900 block mb-2">
                Salario
            </label>
            <input type="text" name="salario" id="salario"
                class="bg-gray-50 border border-gray-300 text-gray-900
                sm:text-sm rounded-1g focus:ring-blue-500 focus:border-blue-500
                block w-full p-1 px-2" value="{{ request()->query('salario') }}">
        </div>

        <div class="mb-3">
            <label for="departamento"
                class="text-sm font-medium text-gray-900 block mb-2">
                Departamento
            </label>
            <input type="text" name="departamento" id="departamento"
                class="bg-gray-50 border border-gray-300 text-gray-900
                sm:text-sm rounded-1g focus:ring-blue-500 focus:border-blue-500
                block w-full p-1 px-2" value="{{ request()->query('departamento') }}">
        </div>
        <button type="submit"
            class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4
            focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1 text-center">
            Buscar
        </button>
        <a href="/emple"
            class="text-white border-gray-500 border-2 bg-gray-500 focus:ring-4
            focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-1 text-center">
            Limpiar
        </a>
    </form>
</div>
