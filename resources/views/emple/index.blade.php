<x-layout>
    <x-emple.search/>
    <div class="flex flex-col items-center mt-4">
        <h1 class="mb-4 text-2xl font-semibold">Empleados</h1>
        <div class="border border-gray-200 shadow">
            <table>
                <thead class="bg-gray-50">
                    <tr>
                        @php
                            $link = e("nombre=" . request()->query('nombre')
                                . "&fecha_alt=" . request()->query('fecha_alt')
                                . "&salario=" . request()->query('salario')
                                . "&departamento=" . request()->query('departamento'));
                        @endphp
                        <th class="px-6 py-2 text-xs text-gray-500">
                            <a href="/emple?orden=nombre&{!! $link !!}">
                                Nombre
                            </a>
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            <a href="/emple?orden=fecha_alt&{!! $link !!}">
                                Fecha de alta
                            </a>
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            <a href="/emple?orden=salario&{!! $link !!}">
                                Salario
                            </a>
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            <a href="/emple?orden=denominacion&{!! $link !!}">
                                Departamento
                            </a>
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            Editar
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            Borrar
                        </th>
                    </tr>
                </thead>
                @foreach ($empleados as $emples)
                    <tbody class="bg-white">
                        <tr class="whitespace-nowrap">
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    <a href="/emple/{{ $emples->id }}" class="text-blue-800 hover:underline">
                                        {{ $emples->nombre }}
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{$emples->fecha_alt}}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{$emples->salario}}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{$emples->denominacion}}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="/emple/{{ $emples->id }}/edit"
                                    class="px-4 py-1 text-sm text-white bg-blue-400 rounded">
                                        Editar
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <form action="/emple/{{ $emples->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('¿Borrar empleado?')"
                                        class="px-4 py-1 text-sm text-white bg-red-400 rounded">
                                        Borrar
                                </form>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>

        <a href="/emple/create" class=" mt-4 text-white bg-green-400 hover:bg-green-500 focus:ring-4
            focus:ring-green-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Insertar nuevo empleado
        </a>
    </div>
    {{ $empleados->links() }}
</x-layout>
