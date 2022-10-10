<div>
    <x-card title="Gestion de Asignatura" cardClasses="border"> 
        <x-slot name="action">
            <x-button href="{{ route('profesor.asignatura', $asignatura) }}" icon="arrow-left" rounded label="Volver" />
        </x-slot>
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
                <div x-data="{ photoName: null, photoPreview: null }" class="flex flex-col items-center text-center justify-center h-full">
                    <input type="file" class="hidden" wire:model="photo" x-ref="photo"
                        x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                    <div class="text-4xl sm:text-7xl font-extrabold leading-none tracking-tight text-center drop-shadow-md">

                        {{-- Actual imagen de la asignatura: --}}
                        <div x-show="! photoPreview">
                            <span class="bg-clip-text text-transparent bg-cover bg-no-repeat bg-center"
                                style="background-image:url({{ $asignatura->banner_url }});">
                                {{ $asignatura->nombre }}
                            </span>
                        </div>

                        {{-- Nueva imagen de la asignatura: --}}
                        <div x-show="photoPreview">
                            <span class="bg-clip-text text-transparent bg-cover bg-no-repeat bg-center"
                                x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                {{ $asignatura->nombre }}
                            </span>
                        </div>

                    </div>

                    <div class="w-52 h-1 bg-teal-600 rounded mt-2 mb-4"></div>

                    <x-button class="mt-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Cambiar Banner') }}
                    </x-button>
                    <x-jet-input-error for="photo" class="mt-2" />

                </div>
            </div>
            <div class="col-span-6 sm:col-span-3">

                @if ($photo)
                    <div class="shadow-md rounded-lg  bg-cover bg-center"
                        style="background-image:url({{ $photo->temporaryUrl() }});">
                @else
                    <div class="shadow-md rounded-lg  bg-cover bg-center"
                        style="background-image:url({{ $asignatura->banner_url }});">
                @endif
                        <div class="p-4 flex flex-col items-start bg-gradient-to-r from-white/50 to-white rounded-lg ring-2 ring-gray-300">
                            <span class="inline-block py-1 px-2 rounded-md bg-green-100 text-green-900 text-sm font-normal tracking-widest uppercase">
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

                                <x-button disabled class="inline-flex items-center" label="Ingresar" right-icon="arrow-right" green lg />

                                <span
                                    class="text-gray-400 mr-3 inline-flex items-center ml-auto leading-none text-md pr-3 py-1 border-r-2 border-gray-200"
                                    title="Nombre del curso">
                                    <x-icon class="text-gray-400 h-5 mr-2" name="flag" />
                                    <p>{{ $asignatura->curso->nombre }}</p>
                                </span>
                                <span
                                    class="text-gray-400 mr-3 inline-flex items-center leading-none text-md pr-3 py-1 border-r-2 border-gray-200"
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
        </div>

        <x-section-border class="mt-2 mb-2" />

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <x-input label="Nombre" placeholder="Nombre" wire:model="input.nombre" />
            <x-input label="Codigo" placeholder="Codigo" wire:model.defer="input.codigo" disabled />
            <x-textarea label="Descripción" placeholder="Descripción" wire:model.defer="input.descripcion" />
        </div>

        <x-slot name="footer">
            <div class="flex items-center gap-x-3 justify-end">
                <x-button wire:click="cancel" label="Cancel" flat />
                <x-button wire:click="save" label="Save" spinner="save" primary />
            </div>
        </x-slot>
    </x-card>
</div>
