<x-layout>
    <form action="{{ route('emple.update', $emple->id, false) }}" method="POST">
        @method('PUT')
        <x-emple.form
            :nombre="$emple->nombre"
            :fecha_alt="$emple->fecha_alt"
            :salario="$emple->salario"
            :depart_id="$emple->depart_id" />
    </form>
</x-layout>
