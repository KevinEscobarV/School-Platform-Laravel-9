<x-app-layout>

    <x-slot name="breadcrumb">
        <x-link-breadcrumb name="Mis Asignaturas" href="{{ route('estudiante.asignaturas') }}" />
        <x-link-breadcrumb name="{{ $asignatura->nombre }}"
            href="{{ route('estudiante.asignaturas.show', $asignatura) }}" />
        <x-link-breadcrumb name="{{ $school_work->nombre }}" />
    </x-slot>

    <div class="px-5 pb-12 mx-auto ">
        <div class="md:grid md:grid-cols-8 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-3">
                <x-card cardClasses="border">
                    <x-slot name="title">
                        <div class="flex">
                            <x-icon name="briefcase" class="w-6 h-6 text-orange-600 mr-3" />
                            <p>{{ $school_work->nombre }}</p>
                        </div>
                    </x-slot>
                    <p class="pb-3 text-justify">
                        {{ $school_work->contenido }}
                    </p>
                    <dl>
                        <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Fecha de inicio para realizar entrega:</dt>
                            <dd class="mt-1 text-sm text-red-900 sm:mt-0 sm:col-span-2 uppercase">
                                {{ $school_work->fecha_inicio_carbon->translatedFormat('j \\de F, Y, h:i:s A') }}</dd>
                            </dd>
                        </div>
                        <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Fecha limite de entrega:</dt>
                            <dd class="mt-1 text-sm text-red-900 sm:mt-0 sm:col-span-2 uppercase">
                                {{ $school_work->fecha_fin_carbon->translatedFormat('j \\de F / Y / h:i:s a') }} -
                                {{ $school_work->fecha_fin_carbon->diffForHumans() }}</dd>
                        </div>
                        <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Se permite subir archivos:</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                @if ($school_work->files)
                                    <x-icon name="check-circle" class="w-6 h-6 text-green-500" style="solid" />
                                @else
                                    <x-icon name="x-circle" class="w-6 h-6 text-red-500" style="solid" />
                                @endif
                            </dd>
                        </div>
                        <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Se permite editar la entrega:</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                @if ($school_work->edit)
                                    <x-icon name="check-circle" class="w-6 h-6 text-green-500" style="solid" />
                                @else
                                    <x-icon name="x-circle" class="w-6 h-6 text-red-500" style="solid" />
                                @endif
                            </dd>
                        </div>
                        <div class="pt-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Material de apoyo del tema:</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                    @forelse ($school_work->tema->tema_files as $file)
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <x-icon name="paper-clip" class="flex-shrink-0 h-5 w-5 text-gray-400" />
                                                <span class="ml-2 flex-1 w-0 truncate"> {{ $file->name }} </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <x-button href="{{ Storage::url($file->file_path) }}" download="{{ $file->name }}" icon="download" sm emerald outline label="Descargar" />
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
                    </dl>
                </x-card>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-5">
                @if ($school_work->fecha_fin_carbon->isPast())
                    <div
                        class="shadow-md overflow-hidden sm:rounded-lg border-2 bg-red-50 border-red-300 px-5 py-4 text-red-400 flex">
                        <x-icon name="clock" class="w-6 h-6 text-red-400 mr-2" />
                        La fecha limite para entregar la tarea ha pasado.
                    </div>
                @elseif ($school_work->fecha_inicio_carbon->isFuture())
                    <div
                        class="shadow overflow-hidden sm:rounded-lg border-2 border-orange-500 bg-gray-50 px-5 py-4 text-orange-700 flex">
                        <x-icon name="clock" class="w-6 h-6 text-orange-600 mr-2" />
                        Aun no es el momento de entregar la tarea.
                    </div>
                @elseif (!$entrega)
                    <livewire:entrega-component :school_work="$school_work">
                @endif
                @if ($entrega)
                    <x-card cardClasses="border">
                        <x-slot name="title">
                            <div class="flex">
                                <x-icon name="check-circle" class="w-6 h-6 text-green-500 mr-3" />
                                <p>Entrega Realizada</p>
                            </div>
                        </x-slot>
                        <x-slot name="action">
                            <div class="mt-1 text-sm text-red-900 sm:mt-0 sm:col-span-2 uppercase">
                                {{ $entrega->updated_at->translatedFormat('j \\de F, Y, h:i:s A') }} -
                                {{ $entrega->updated_at->diffForHumans() }}</div>
                        </x-slot>
                        <dl>
                            <div class="py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-500">Titulo:</dt>
                                <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $entrega->titulo }}</dd>
                                </dd>
                            </div>
                            <div class="py-4">
                                <x-jet-label for="editorEntrega" value="Contenido" />
                                <textarea id="editorRead">
                                    {{ $entrega->contenido }}
                                </textarea>
                            </div>
                            <div class="py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-500">Archivos adjuntos con la entrega:</dt>
                                <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                    <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                        @forelse ($entrega->entrega_files as $file)
                                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                <div class="w-0 flex-1 flex items-center">
                                                    <x-icon name="paper-clip" class="flex-shrink-0 h-5 w-5 text-gray-400" />
                                                    <span class="ml-2 flex-1 w-0 truncate"> {{ $file->name }} </span>
                                                </div>
                                                <div class="ml-4 flex-shrink-0">
                                                    <a href="{{ Storage::url($file->path) }}"
                                                        class="font-medium text-teal-700 hover:text-teal-600"
                                                        download="{{ $file->name }}"> Descargar
                                                    </a>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                <div class="w-0 flex-1 flex items-center">
                                                    <x-icon name="paper-clip" class="flex-shrink-0 h-5 w-5 text-gray-400" />
                                                    <span class="ml-2 flex-1 w-0 truncate"> No se adjuntaron archivos
                                                    </span>
                                                </div>
                                            </li>
                                        @endforelse
                                    </ul>
                                </dd>
                            </div>
                        </dl>
                        @if ($school_work->edit)
                            <x-slot name="footer">
                                <div class="flex justify-end items-center">
                                    <livewire:edit-entrega-component :entrega="$entrega">
                                </div>
                            </x-slot>
                        @endif
                    </x-card>
                    @push('scripts')
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#editorRead'))
                            .then(function(editor) {
                                const toolbarElement = editor.ui.view.toolbar.element;
                                affectsData = 'false';
                                editor.isReadOnly = 'true';
                                // toolbarElement.style.display = 'none';
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                @endpush
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
