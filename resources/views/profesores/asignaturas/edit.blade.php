<x-app-layout>

    <x-slot name="breadcrumb">
        <x-link-breadcrumb name="Administración" href="{{ route('profesor.index') }}" />
        <x-link-breadcrumb name="{{ $asignatura->nombre }}" href="{{ route('profesor.asignatura', $asignatura) }}" />
        <x-link-breadcrumb name="Configuración" href="{{ route('profesor.asignatura.edit', $asignatura) }}" />
    </x-slot>

    <div class="px-4 mb-6 mx-auto">
        <livewire:asignatura-banner :asignatura="$asignatura" />
    </div>

</x-app-layout>
