<div>
    <div class="md:grid md:grid-cols-6 md:gap-6">
        <div class="mt-5 md:mt-0 md:col-span-3">
            <x-card title="Formulario para creación de un Tema" cardClasses="border">
                <div class="grid grid-cols-6 gap-6">
                    <!-- Titulo -->
                    <div class="col-span-6 sm:col-span-6">
                        <x-input right-icon="pencil" label="Título" placeholder="Titulo del Tema"
                            wire:model="input.titulo" />
                    </div>
                    <!-- Contenido -->
                    <div class="col-span-6 sm:col-span-6">
                        <x-textarea wire:model="input.contenido" label="Contenido" placeholder="Descripción del Tema" />
                    </div>
                    <!-- Subir Archivos -->
                    <div class="col-span-6 sm:col-span-3">
                        <x-jet-label for="files" value="Subir Archivos / Material de Apoyo" />
                        <label for="file-upload" class="cursor-pointer">
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-500">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                    </svg>
                                    <div class="text-sm text-gray-600">
                                        <div
                                            class="relative bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Subir Archivos / Material de Apoyo</span>
                                            <input id="file-upload" name="file-upload" wire:model="files_paths"
                                                type="file"
                                                accept=".doc,.docx,.pdf,.txt,.jpeg,.png,.jpg,.gif,.svg,.xls,.xlsx,.ppt,.pptx,.zip,.rar"
                                                class="sr-only" multiple>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500">DOC, DOCX, PDF, TXT, JPEG, PNG, JPG, GIF, SVG, XLS,
                                        XLSX, PPT, PPTX, ZIP, RAR</p>
                                    <p class="text-xs text-gray-500">hasta 10 MB</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    <!-- Archivos subidos -->
                    @if ($files_paths)
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label for="files" value="Archivos" />
                            <x-jet-input-error for="files_paths.*" />
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                    @foreach ($files_paths as $file)
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <!-- Heroicon name: solid/paper-clip -->
                                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="ml-2 flex-1 w-0 truncate">
                                                    {{ $file->getClientOriginalName() }}
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </dd>
                        </div>
                    @endif
                </div>
                <x-slot name="footer">
                    <div class="flex justify-end items-center">
                        <x-button wire:click="save" wire:loading.attr="disabled" wire:target="save" icon="check" teal label="Crear Tema" />
                    </div>
                </x-slot>
            </x-card>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-3">
            <x-card title="Temas creados en Asignatura" cardClasses="border">
                <table class="border-collapse w-full text-sm table-fixed md:table-auto">
                    <thead>
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                Título
                            </th>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                Fecha de Creación
                            </th>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-center">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-slate-800">
                        @forelse ($temas as $tema)
                            <tr>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400 truncate">
                                    <a href="{{route('profesor.asignatura.tema', [$asignatura, $tema])}}" class="hover:text-indigo-600 transform transition hover:scale-105 flex" title="{{ $tema->titulo }}">
                                        <x-icon name="arrow-right" class="w-5 h-5 mr-2" />
                                        {{ $tema->titulo }}
                                    </a>
                                </td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                    {{ $tema->created_at }}
                                </td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                    <div class="flex justify-evenly gap-x-3">
                                        <x-button.circle wire:click="editTema('{{ $tema->id }}')" xs teal outline icon="pencil" />
                                        <x-button.circle x-on:confirm="{
                                            title: '¿Estás seguro de eliminar este tema?',
                                            acceptLabel: 'Confirmar',
                                            rejectLabel: 'Cancelar',
                                            icon: 'warning',
                                            method: 'delete',
                                            params: {{ $tema->id }}
                                            }" negative outline xs icon="x" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="border-b border-red-100 dark:border-red-700 p-4 dark:text-red-400 truncate text-red-800">
                                    Vacío
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($temas->hasPages())
                    <div class="px-3 mt-4">
                        {{ $temas->links() }}
                    </div>
                @endif
            </x-card>
        </div>
    </div>

    <x-modal.card title="Editar Tema" blur max-width="4xl" wire:model.defer="open" z-index="z-40">
        <div class="grid grid-cols-6 gap-4">
            <!-- Titulo -->
            <div class="col-span-6 sm:col-span-6">
                <x-input right-icon="pencil" label="Título" placeholder="Titulo de la entrega"
                    wire:model.defer="editInput.titulo" />
            </div>
            <!-- Contenido -->
            <div class="col-span-6 sm:col-span-6">
                <x-textarea wire:model="editInput.contenido" label="Contenido" placeholder="Descripción del Tema" />
            </div>
            <!-- Subir Archivos -->
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="files" value="Subir Archivos / Material de Apoyo" />
                <label for="file-upload" class="cursor-pointer">
                    <div
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-500">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                            </svg>
                            <div class="text-sm text-gray-600">
                                <div
                                    class="relative bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Subir Archivos / Material de Apoyo</span>
                                    <input id="file-upload" name="file-upload" wire:model="editFiles_paths" type="file"
                                        accept=".doc,.docx,.pdf,.txt,.jpeg,.png,.jpg,.gif,.svg,.xls,.xlsx,.ppt,.pptx,.zip,.rar"
                                        class="sr-only" multiple>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500">DOC, DOCX, PDF, TXT, JPEG, PNG, JPG, GIF, SVG, XLS,
                                XLSX, PPT, PPTX, ZIP, RAR</p>
                            <p class="text-xs text-gray-500">hasta 10 MB</p>
                        </div>
                    </div>
                </label>
            </div>
            <!-- Archivos subidos -->
            <div class="col-span-6 sm:col-span-3">
                @if ($editFiles_paths)
                    <x-jet-label for="files" value="Archivos" />
                    <x-jet-input-error for="files_paths.*" />
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            @forelse ($editFiles_paths as $file)
                                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                    <div class="w-0 flex-1 flex items-center">
                                        <!-- Heroicon name: solid/paper-clip -->
                                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2 flex-1 w-0 truncate">
                                            {{ $file->name }}
                                        </span>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <div class="flex justify-evenly gap-x-3">
                                            <a x-on:confirm="{
                                                title: '¿Estás seguro de eliminar este Archivo?',
                                                acceptLabel: 'Confirmar',
                                                rejectLabel: 'Cancelar',
                                                icon: 'warning',
                                                method: 'deleteFile',
                                                params: {{ $file->id }}
                                                }">
                                                <x-icon name="trash" class="w-5 h-5 cursor-pointer text-red-500 hover:text-red-700" />
                                            </a>
                                            <a href="{{ Storage::url($file->file_path) }}"
                                                class="font-medium text-teal-700 hover:text-indigo-600" download="{{$file->name}}">
                                                <x-icon name="download" class="w-5 h-5 cursor-pointer" />
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                    <div class="w-0 flex-1 flex items-center">
                                        <!-- Heroicon name: solid/paper-clip -->
                                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2 flex-1 w-0 truncate">
                                            NO SE SUBIO NINGUN ARCHIVO
                                        </span>
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </dd>
                @endif

                @if ($files_paths)
                    <x-jet-label for="files" value="Archivos Nuevos" class="mt-3" />
                    <x-jet-input-error for="files_paths.*" />
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            @foreach ($files_paths as $file)
                                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                    <div class="w-0 flex-1 flex items-center">
                                        <!-- Heroicon name: solid/paper-clip -->
                                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2 flex-1 w-0 truncate">
                                            {{ $file->getClientOriginalName() }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </dd>
                @endif
            </div>

        </div>
        <x-slot name="footer">
            <div class="flex justify-between gap-x-4">
                <x-button flat label="Cancel" x-on:click="close" />
                <x-button wire:click="update" wire:loading.attr="disabled" wire:target="update" icon="check" teal label="Guardar Tema" />
            </div>
        </x-slot>
    </x-modal.card>
</div>
