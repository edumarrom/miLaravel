<x-layout>
    <form action="{{ route('emple.store', [], false) }}" method="POST">
        <x-emple.form
            :nombre="''"
            :fecha_alt="''"
            :salario="''"
            :depart_id="''" />
    </form>
</x-layout>
