<x-app-layout>

    <x-slot name="breadcrumb">
        <x-link-breadcrumb name="Mis Asignaturas" href="{{ route('estudiante.asignaturas') }}" />
        <x-link-breadcrumb name="{{ $asignatura->nombre }}"
            href="{{ route('estudiante.asignaturas.show', $asignatura) }}" />
    </x-slot>

    <div class="px-4 mx-auto">
        <x-card title="Gestion de Asignatura" cardClasses="border">
            <div class="text-4xl sm:text-6xl font-extrabold leading-none tracking-tight text-center drop-shadow-md">
                <span class="bg-clip-text text-transparent bg-center bg-cover"
                    style="background-image:url({{ $asignatura->banner_path }});">
                    {{ $asignatura->nombre }}
                </span>
            </div>
            <p>
                {{ $asignatura->descripcion }}
            </p>
            <div class="flex items-center mt-4">
                <div class="flex-shrink-0 h-10 w-10">
                    <img class="h-10 w-10 rounded-xl object-cover" src="{{ $asignatura->user->profile_photo_url }}"
                        alt="{{ $asignatura->user->name }}">
                </div>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                        {{ $asignatura->user->name }}
                        {{ $asignatura->user->apellido }}</div>
                    <div class="text-sm text-gray-500">{{ $asignatura->user->email }}</div>
                </div>
            </div>
        </x-card>
    </div>

    <div class="px-4 py-6 mx-auto">
            <x-card title="Temas de Asignatura" cardClasses="border">
            <div class="grid grid-cols-6 gap-6">
                @foreach ($asignatura->temas as $tema)
                    <div class="col-span-6 sm:col-span-3 border rounded-lg">
                        <h3 class="px-2 py-1 bg-teal-600 text-white text-lg rounded-t-lg border-b">{{ $tema->titulo }}</h3>
                        <p class="ml-4 mt-3">{{ $tema->contenido }}</p>
                        <x-section-border />
                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Material de Apoyo</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                    @forelse ($tema->tema_files as $file)
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <x-icon name="paper-clip" class="flex-shrink-0 h-5 w-5 text-gray-400" />
                                                <span class="ml-2 flex-1 w-0 truncate"> {{ $file->name }} </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <x-button href="{{ Storage::url($file->file_path) }}" icon="download" sm teal outline label="Descargar" />
                                            </div>
                                        </li>
                                    @empty
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <x-icon name="paper-clip" class="flex-shrink-0 h-5 w-5 text-gray-400" />
                                                <span class="ml-2 flex-1 w-0 truncate"> No hay archivos adjuntos </span>
                                            </div>
                                        </li>
                                    @endforelse
                                </ul>
                            </dd>
                        </div>
                        <x-section-border />
                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Actividades</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                    @forelse ($tema->school_works as $schoolWork)
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <x-icon name="clipboard-check" class="flex-shrink-0 h-5 w-5 text-gray-400" />
                                                <span class="ml-2 flex-1 w-0 truncate"> {{ $schoolWork->nombre }}
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <x-button href="{{ route('estudiante.school_work', [$asignatura, $tema, $schoolWork]) }}" icon="check" sm orange label="Realizar Entrega" />
                                            </div>
                                        </li>
                                    @empty
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <x-icon name="clipboard-check" class="flex-shrink-0 h-5 w-5 text-gray-400" />
                                                <span class="ml-2 flex-1 w-0 truncate"> No hay actividades asignadas
                                                </span>
                                            </div>
                                        </li>
                                    @endforelse
                                </ul>
                            </dd>
                        </div>
                    </div>
                @endforeach
            </div>
            </x-card>
    </div>

</x-app-layout>
