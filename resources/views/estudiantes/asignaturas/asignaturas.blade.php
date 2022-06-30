<x-app-layout>

    <x-slot name="breadcrumb">
        <x-link-breadcrumb name="Mis Asignaturas" href="{{ route('estudiante.asignaturas') }}" />
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{auth()->user()->curso->nombre}}
        </h2>
    </x-slot>

    <div class="px-5 py-6 mx-auto">
        <div class="grid grid-cols-6 gap-6">
            @forelse ($asignaturas as $asignatura)
                <div class="col-span-6 sm:col-span-3">
                    <div class="shadow-md rounded-lg  bg-cover bg-center"
                        style="background-image:url({{ $asignatura->banner_path }});">
                        <div class="p-4 flex flex-col items-start bg-gradient-to-r from-white/80 to-white rounded-lg ring-2 ring-gray-300">
                            <span
                                class="inline-block py-1 px-2 rounded-md bg-green-100 text-green-900 text-sm font-normal tracking-widest uppercase">
                                {{ $asignatura->codigo }}
                            </span>
                            <div class="mt-4 text-4xl sm:text-5xl font-extrabold leading-none tracking-tight text-center drop-shadow-md">
                                <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-800 to-teal-500">
                                    {{ $asignatura->nombre }}
                                </span>
                            </div>
                            <div>
                                <p class="leading-relaxed mb-8">{{ $asignatura->descripcion }}</p>
                            </div>
                            <div class="flex items-center flex-wrap pb-4 mb-4 border-b-2 border-gray-100 mt-auto w-full md:items-baseline">
                                <x-button class="inline-flex items-center"
                                    href="{{ route('estudiante.asignaturas.show', $asignatura) }}" label="Ingresar"
                                    right-icon="arrow-right" green lg />
                                <span class="text-gray-400 mr-3 inline-flex items-center ml-auto leading-none text-md pr-3 py-1 border-r-2 border-gray-200"
                                    title="Nombre del curso">
                                    <x-icon class="text-gray-400 h-5 mr-2" name="flag" />
                                    <p>{{ $asignatura->curso->nombre }}</p>
                                </span>
                                <span class="text-gray-400 mr-3 inline-flex items-center leading-none text-md pr-3 py-1 border-r-2 border-gray-200"
                                    title="Cantidad de Temas">
                                    <x-icon class="text-gray-400 h-5 mr-2" name="bookmark" />
                                    <p>{{ $asignatura->temas->count() }}</p>
                                </span>
                                <span class="text-gray-400 inline-flex items-center leading-none text-md"
                                    title="Cantidad de Estudiantes">
                                    <x-icon class="text-gray-400 h-5 mr-2" name="user" />
                                    <p>{{ $asignatura->curso->students->count() }}</p>
                                </span>
                            </div>
                            @if ($asignatura->user)
                                <a class="inline-flex items-center">
                                    <img alt="{{ $asignatura->user->name }}"
                                        src="{{ $asignatura->user->profile_photo_url }}"
                                        class="w-10 h-10 rounded-full flex-shrink-0 object-cover object-center">
                                    <span class="flex-grow flex flex-col pl-4">
                                        <span class="title-font font-medium text-gray-900">
                                            {{ $asignatura->user->name }}
                                        </span>
                                        <span class="text-gray-800 text-xs tracking-widest mt-0.5">
                                            {{ $asignatura->user->email }}
                                        </span>
                                    </span>
                                </a>
                            @else
                                <p class="py-1 px-2 bg-orange-100 text-orange-800 rounded-md">
                                    No tiene asignado un Profesor
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                No cuenta con ninguna asignatura
            @endforelse
        </div>
    </div>

    @if ($asignaturas->hasPages())
        <div class="bg-white px-4 py-2 mx-4 mb-4 shadow-md rounded-md border-2 border-gray-100">
            {{ $asignaturas->links() }}
        </div>
    @endif

</x-app-layout>
