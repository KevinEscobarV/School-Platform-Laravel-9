<x-app-layout>

    <x-slot name="breadcrumb">
        <x-link-breadcrumb name="Administración" href="{{ route('profesor.index') }}" />
        <x-link-breadcrumb name="{{ $asignatura->nombre }}"
            href="{{ route('profesor.asignatura', $asignatura) }}" />
    </x-slot>

    <div class="px-4 mx-auto">
        <x-card title="Gestion de Asignatura" cardClasses="border">
            <x-slot name="action">
                <x-button href="{{ route('profesor.asignatura.edit', $asignatura) }}" icon="cog" rounded label="Modificar" />
            </x-slot>
            <div class="text-4xl sm:text-6xl font-extrabold leading-none tracking-tight text-center drop-shadow-md">
                <span class="bg-clip-text text-transparent bg-center bg-cover"
                    style="background-image:url({{ $asignatura->banner_url }});">
                    {{ $asignatura->nombre }}
                </span>
            </div>
            <p>
                {{ $asignatura->descripcion }}
            </p>
        </x-card>
    </div>

    <div class="px-4 py-4 mx-auto ">
        <livewire:tema-component :asignatura="$asignatura">
    </div>

</x-app-layout>
