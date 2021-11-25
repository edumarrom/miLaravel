<x-layout>
    <form action="/depart" method="POST">
        @csrf
        <div class="mb-6">
            <label for="denominacion"
            class="text-sm font-medium text-gray-900 block mb-2">Denominación</label>
            <input type="text" id="denominacion" name="denominacion"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div class="mb-6">
            <label for="localidad"
            class="text-sm font-medium text-gray-900 block mb-2">Localidad</label>
            <input type="text" id="localidad" name="localidad"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300
            font-medium rounded-lg text-sm px-5 py-2.5 text-center">Enviar</button>
        <button
            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300
            font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <a href="/depart">Volver</a>
        </button>
        </form>
</x-layout>
