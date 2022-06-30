<div>

    <x-jet-form-section submit="saveData">
    <x-slot name="title">
        Información adicional de Usuario
    </x-slot>

    <x-slot name="description">
        Actualizar Informacion adicional de Usuario.
        @if ($user->data == false)
        <div class="p-3 mt-3 rounded-md bg-orange-400 text-white shadow-sm text-center">
            <p>No tiene Información adicional</p>
        </div>
        @endif
    </x-slot>

    <x-slot name="form">

        <!-- Fecha de Nacimiento -->
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="fecha_nacimiento" value="Fecha de Nacimiento" />
            <x-jet-input id="fecha_nacimiento" type="date" class="mt-1 block w-full" wire:model="data.fecha_nacimiento" />
            <x-jet-input-error for="data.fecha_nacimiento" class="mt-2" />
        </div>

        <!-- Lugar de Nacimiento -->
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="lugar_nacimiento" value="Lugar de Nacimiento" />
            <x-jet-input id="lugar_nacimiento" type="text" class="mt-1 block w-full" wire:model="data.lugar_nacimiento" />
            <x-jet-input-error for="data.lugar_nacimiento" class="mt-2" />
        </div>

        <!-- Telefono -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="telefono" value="Telefono" />
            <x-jet-input id="telefono" type="tel" class="mt-1 block w-full" wire:model="data.telefono" />
            <x-jet-input-error for="data.telefono" class="mt-2" />
        </div>

        <!-- EPS -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="eps" value="EPS" />
            <x-jet-input id="eps" type="text" class="mt-1 block w-full" wire:model="data.eps" />
            <x-jet-input-error for="data.eps" class="mt-2" />
        </div>

        <!-- Religion -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="religion" value="Religion" />
            <x-jet-input id="religion" type="text" class="mt-1 block w-full" wire:model="data.religion" />
            <x-jet-input-error for="data.religion" class="mt-2" />
        </div>

        <!-- Caja de compensacion familiar -->
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="caja_comp_familiar" value="Caja de compensacion familiar" />
            <x-jet-input id="caja_comp_familiar" type="text" class="mt-1 block w-full" wire:model="data.caja_comp_familiar" />
            <x-jet-input-error for="data.caja_comp_familiar" class="mt-2" />
        </div>

        <!-- Grupo Afro -->
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="grupo_afro" value="Grupo Afro" />
            <x-jet-input id="grupo_afro" type="text" class="mt-1 block w-full" wire:model="data.grupo_afro" />
            <x-jet-input-error for="data.grupo_afro" class="mt-2" />
        </div>

        <!-- Trabajo Actual -->
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="tabajo_actual" value="Trabajo Actual" />
            <x-jet-input id="tabajo_actual" type="text" class="mt-1 block w-full" wire:model="data.tabajo_actual" />
            <x-jet-input-error for="data.tabajo_actual" class="mt-2" />
        </div>

         <!-- Cantidad de personas con las que vive -->
         <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="cant_personas_viven" value="Cantidad de personas con las que vive" />
            <x-jet-input id="cant_personas_viven" type="number" class="mt-1 block w-full" wire:model="data.cant_personas_viven" />
            <x-jet-input-error for="data.cant_personas_viven" class="mt-2" />
        </div>

        <!-- Cantidad de años repetidos -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="cant_year_repetidos" value="Cantidad de años repetidos" />
            <x-jet-input id="cant_year_repetidos" type="number" class="mt-1 block w-full" wire:model="data.cant_year_repetidos" />
            <x-jet-input-error for="data.cant_year_repetidos" class="mt-2" />
        </div>

        <!-- Cantidad de años preescolar -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="cant_year_preescolar" value="Cantidad de años preescolar" />
            <x-jet-input id="cant_year_preescolar" type="number" class="mt-1 block w-full" wire:model="data.cant_year_preescolar" />
            <x-jet-input-error for="data.cant_year_preescolar" class="mt-2" />
        </div>

        <!-- Cantidad de años antes de preescolar -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="cant_year_antes_preescolar" value="Cantidad de años antes de preescolar" />
            <x-jet-input id="cant_year_antes_preescolar" type="number" class="mt-1 block w-full" wire:model="data.cant_year_antes_preescolar" />
            <x-jet-input-error for="data.cant_year_antes_preescolar" class="mt-2" />
        </div>

        <!-- Cantidad de hijios -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="cant_hijos" value="Cantidad de hijos" />
            {{-- <x-jet-input id="cant_hijos" type="number" class="mt-1 block w-full" wire:model="data.cant_hijos" /> --}}
                <x-jet-input id="cant_hijos" type="number" class="mt-1 block w-full" wire:model="data.cant_hijos" />
            <x-jet-input-error for="data.cant_hijos" class="mt-2" />
        </div>

        <!-- Cantidad de antecedentes disciplinarios -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="cant_ant_disciplinarios" value="Antecedentes disciplinarios" />
            <x-jet-input id="cant_ant_disciplinarios" type="number" class="mt-1 block w-full" wire:model="data.cant_ant_disciplinarios" />
            <x-jet-input-error for="data.cant_ant_disciplinarios" class="mt-2" />
        </div>

        <!-- Cantidad de hermanos -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="cant_hermanos" value="Cantidad de hermanos" />
            <x-jet-input id="cant_hermanos" type="number" class="mt-1 block w-full" wire:model="data.cant_hermanos" />
            <x-jet-input-error for="data.cant_hermanos" class="mt-2" />
        </div>

        <!-- Genero -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="genero_id" value="Genero" />
            <select id="genero_id" wire:model="data.genero_id"
                    class="border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                <option selected disabled value="">Seleccione un Genero</option>
                @foreach ($generos as $genero)
                    <option value="{{$genero->id}}">{{$genero->nombre}}</option>
                @endforeach
            </select>

            <x-jet-input-error for="data.genero_id" class="mt-2" />
        </div>

        <!-- Tipo de Sangre -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="tipo_sangre_id" value="Tipo de Sangre" />
            <select id="tipo_sangre_id" wire:model="data.tipo_sangre_id"
                    class="border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                <option selected disabled value="">Seleccione un tipo de Sangre</option>
                @foreach ($tiposrh as $rh)
                    <option value="{{$rh->id}}">{{$rh->tipo}} {{$rh->rh}}</option>
                @endforeach
            </select>

            <x-jet-input-error for="data.tipo_sangre_id" class="mt-2" />
        </div>

        <!-- Tipo de Sangre -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="tipo_vivienda_id" value="Tipo de Vivienda" />
            <select id="tipo_vivienda_id" wire:model="data.tipo_vivienda_id"
                    class="border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                <option selected disabled value="">Seleccione un tipo de Vivienda</option>
                @foreach ($tiposvivienda as $vivienda)
                    <option value="{{$vivienda->id}}">{{$vivienda->tipo}}</option>
                @endforeach
            </select>

            <x-jet-input-error for="data.tipo_vivienda_id" class="mt-2" />
        </div>
 
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            Información Actualizada.
        </x-jet-action-message>
        <x-jet-button wire:loading.attr="disabled" wire:target="saveData">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
</div>