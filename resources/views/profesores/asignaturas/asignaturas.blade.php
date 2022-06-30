<x-app-layout>

    <x-slot name="breadcrumb">
        <x-link-breadcrumb name="Mis Asignaturas" href="{{ route('estudiante.asignaturas') }}" />
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
           name
        </h2>
    </x-slot>

</x-app-layout>