<div>
    <x-card title="Creacion de Asignatura" cardClasses="border mb-6">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
                <x-input label="Nombre" wire:model="input.nombre" icon="pencil-alt" placeholder="Nombre de la Asignatura" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-input label="Slug ( Url amigable )" right-icon="eye" wire:model.lazy="input.slug"
                    placeholder="Url Amigable - Se llena automaticamente" disabled />
            </div>
            <div class="col-span-6 sm:col-span-3">

                <x-select label="Selecciona un usuario" wire:model.defer="asyncSearchUser" placeholder="Selecciona un usuario"
                    :async-data="route('api.users.index')" 
                    :template="[
                        'name' => 'user-option',
                        'config' => ['src' => 'profile_photo_url'],
                    ]" 
                    option-label="apellido" option-value="id"
                    option-description="email" />
            </div>
        </div>
    </x-card>
</div>
