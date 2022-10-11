<x-app-layout>

    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Asignaturas
        </h2>
    </x-slot> --}}

    <x-slot name="breadcrumb">
        <x-link-breadcrumb name="Administrador" href="#" />
        <x-link-breadcrumb name="Gestion de Asignaturas" href="{{ route('admin.asignaturas.index') }}" />
    </x-slot>

    <div class="px-4 pb-4 mx-auto">
            <livewire:admin.asignaturas-component />
    </div>


</x-app-layout>
