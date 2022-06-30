<x-app-layout>

    <x-slot name="breadcrumb">
        <x-link-breadcrumb name="Administración" href="{{ route('profesor.index') }}" />
        <x-link-breadcrumb name="{{ $asignatura->nombre }}" href="{{ route('profesor.asignatura', $asignatura) }}" />
        <x-link-breadcrumb name="{{ $tema->titulo }}" />
    </x-slot>
    <div class="px-4 mx-auto">
        <x-card title="{{ $tema->titulo }}" cardClasses="border">
            {{ $tema->contenido }}
        </x-card>
    </div>

    <div class="px-4 py-4 mx-auto ">
        <livewire:school-work-component :tema="$tema">
    </div>

</x-app-layout>
