<x-jet-form-section submit="save">
    <x-slot name="title">
        Información de Usuario
    </x-slot>

    <x-slot name="description">
        Actualizar Informacion de Usuario.
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        <div x-data="{photoName: null, photoPreview: null}" class="flex flex-col items-center text-center justify-center col-span-6 sm:col-span-6">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden"
                                wire:model="photo"
                                x-ref="photo"
                                x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                " />
    
                    <x-jet-label for="photo" value="{{ __('Foto de Perfil') }}" />
    
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-xl h-36 w-36 object-cover">
                    </div>
                    
                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="block rounded-xl h-36 w-36 bg-cover bg-no-repeat bg-center"
                              x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>
    
                    <div class="w-24 h-1 bg-green-500 rounded mt-2 mb-4"></div>
    
                    <div>
                        <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Select A New Photo') }}
                        </x-jet-secondary-button>
        
                        @if ($this->user->profile_photo_path)
                            <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto('{{ $user->identificacion }}')">
                                {{ __('Remove Photo') }}
                            </x-jet-secondary-button>
                        @endif
        
                    </div>
                    <x-jet-input-error for="photo" class="mt-2" />
                </div>

        <!-- Name -->
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="user.name" autocomplete="name" />
            <x-jet-input-error for="user.name" class="mt-2" />
        </div>

        <!-- Apellido -->
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="apellido" value="{{ __('Apellido') }}" />
            <x-jet-input id="apellido" type="text" class="mt-1 block w-full" wire:model="user.apellido"
                autocomplete="apellido" />
            <x-jet-input-error for="user.apellido" class="mt-2" />
        </div>

        <!-- Identificacion -->
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="identificacion" value="{{ __('Identificacion') }}" />
            <x-jet-input id="identificacion" type="text" class="mt-1 block w-full" wire:model="user.identificacion"
                autocomplete="identificacion" />
            <x-jet-input-error for="user.identificacion" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model="user.email" />
            <x-jet-input-error for="user.email" class="mt-2" />
        </div>

        <!-- Roles -->
        <div class="col-span-6 sm:col-span-6">
            <hr class="my-2">
            <x-jet-label class="mb-2">
                Rol
            </x-jet-label>
            <div class="grid grid-cols-4">
                @foreach ($roles as $role)
                    <x-jet-label>
                        <x-jet-checkbox wire:model="user_roles" name="user_role[]" value="{{ $role->id }}" />
                        {{ $role->name }}
                    </x-jet-label>
                @endforeach
            </div>
            <x-jet-input-error for="user_roles" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            Información Actualizada.
        </x-jet-action-message>
        <x-jet-button wire:loading.attr="disabled" wire:target="save">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>