<div>
    <div class="md:grid md:grid-cols-6 md:gap-6">
        <div class="mt-5 md:mt-0 md:col-span-3">
            <x-card title="Formulario para creación de una Tarea" cardClasses="border">
                <div class="grid grid-cols-6 gap-6">
                    <!-- Titulo -->
                    <div class="col-span-6 sm:col-span-6">
                        <x-input right-icon="pencil" label="Nombre" placeholder="Nombre de la tarea"
                            wire:model="input.nombre" />
                    </div>
                    <!-- Fecha de Inicio -->
                    <div class="col-span-6 sm:col-span-3">
                        <x-datetime-picker id="start-input" label="Fecha de Inicio" placeholder="Fecha de Inicio"
                            parse-format="YYYY-MM-DD HH:mm" display-format="YYYY-MM-DD hh:mm A"
                            wire:model.defer="input.fecha_inicio" :min="now()" :max="now()->addMonths(12)" />
                    </div>
                    <!-- Fecha de Finalizacion -->
                    <div class="col-span-6 sm:col-span-3">
                        <x-datetime-picker id="finish-input" label="Fecha de finalización"
                            placeholder="Fecha de finalización" parse-format="YYYY-MM-DD HH:mm"
                            display-format="YYYY-MM-DD hh:mm A" wire:model.defer="input.fecha_fin" :min="now()"
                            :max="now()->addMonths(12)" />
                    </div>
                    <!-- Contenido -->
                    <div class="col-span-6 sm:col-span-6">
                        <x-textarea wire:model.defer="input.contenido" label="Contenido"
                            placeholder="Descripción de la tarea" />
                    </div>

                    <!-- Permisos -->
                    <div class="col-span-6 sm:col-span-3">
                        <x-toggle lg wire:model.defer="input.files" label="Permitir subir archivos" />
                    </div>

                    <!-- Permisos -->
                    <div class="col-span-6 sm:col-span-3">
                        <x-toggle lg wire:model.defer="input.edit" label="Permitir editar la entrega" />
                    </div>

                </div>
                <x-slot name="footer">
                    <div class="flex justify-end items-center">
                        <x-button wire:click="save" wire:loading.attr="disabled" wire:target="save" icon="check" teal
                            label="Crear Tarea" />
                    </div>
                </x-slot>
            </x-card>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-3">
            <x-card title="Tareas creadas en Tema" cardClasses="border">
                <table class="border-collapse w-full text-sm table-fixed">
                    <thead>
                        <tr>
                            <th
                                class="border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                Nombre
                            </th>
                            <th
                                class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                Fecha de Inicio
                            </th>
                            <th
                                class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                Fecha de Finalización
                            </th>
                            <th
                                class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                Archivos
                            </th>
                            <th
                                class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                Editable
                            </th>
                            <th
                                class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-center">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-slate-800">
                        @forelse ($works as $work)
                            <tr>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400 truncate"
                                    title="{{ $work->nombre }}">
                                    {{ $work->nombre }}
                                </td>
                                <td
                                    class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                    {{ $work->fecha_inicio_carbon->format('d / m / Y, h:i A') }}
                                </td>
                                <td
                                    class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                    {{ $work->fecha_fin_carbon->format('d / m / Y, h:i A') }}
                                </td>
                                <td
                                    class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                    @if ($work->files)
                                        <x-icon name="check-circle" class="w-6 h-6 text-green-500" style="solid" />
                                    @else
                                        <x-icon name="x-circle" class="w-6 h-6 text-red-500" style="solid" />
                                    @endif
                                </td>
                                <td
                                    class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                    @if ($work->edit)
                                        <x-icon name="check-circle" class="w-6 h-6 text-green-500" style="solid" />
                                    @else
                                        <x-icon name="x-circle" class="w-6 h-6 text-red-500" style="solid" />
                                    @endif
                                </td>
                                <td
                                    class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                    <div class="flex justify-evenly gap-x-3">

                                        <x-button.circle wire:click="editWork('{{ $work->id }}')" xs primary outline
                                            icon="pencil" />
                                        <x-button.circle
                                            x-on:confirm="{
                                                title: '¿Estás seguro de eliminar esta tarea?',
                                                acceptLabel: 'Confirmar',
                                                rejectLabel: 'Cancelar',
                                                icon: 'warning',
                                                method: 'delete',
                                                params: {{ $work->id }}
                                                }"
                                            amber outline xs icon="x" />

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td
                                    class="border-b border-red-100 dark:border-red-700 p-4 dark:text-red-400 truncate text-red-800">
                                    Vacío
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($works->hasPages())
                    <div class="px-3 mt-4">
                        {{ $works->links() }}
                    </div>
                @endif
            </x-card>
        </div>
    </div>

    <x-modal.card title="Editar Tarea" blur max-width="4xl" wire:model.defer="open">
        <div class="grid grid-cols-6 gap-4">
            <!-- Titulo -->
            <div class="col-span-6 sm:col-span-6">
                <x-input right-icon="pencil" label="Nombre" placeholder="Nombre de la tarea"
                    wire:model="editWork.nombre" />
            </div>

            <!-- Fecha de Inicio -->
            <div class="col-span-6 sm:col-span-3">
                <x-datetime-picker id="edit-start-input" label="Fecha de Inicio" placeholder="Fecha de Inicio"
                    parse-format="YYYY-MM-DD HH:mm" display-format="YYYY-MM-DD hh:mm A"
                    wire:model.defer="editWork.fecha_inicio" />

            </div>
            <!-- Fecha de Fin -->
            <div class="col-span-6 sm:col-span-3">
                <x-datetime-picker id="edit-finish-input" label="Fecha de finalización"
                    placeholder="Fecha de finalización" parse-format="YYYY-MM-DD HH:mm"
                    display-format="YYYY-MM-DD hh:mm A" wire:model.defer="editWork.fecha_fin" />
            </div>

            <!-- Contenido -->
            <div class="col-span-6 sm:col-span-6">
                <x-textarea wire:model="editWork.contenido" label="Contenido"
                    placeholder="Descripción de la tarea" />
            </div>

            <!-- Permisos -->
            <div class="col-span-6 sm:col-span-3">
                <x-toggle lg wire:model.defer="editWork.files" label="Permitir subir archivos" />
            </div>

            <!-- Permisos -->
            <div class="col-span-6 sm:col-span-3">
                <x-toggle lg wire:model.defer="editWork.edit" label="Permitir editar la entrega" />
            </div>
        </div>
        <x-slot name="footer">
            <div class="flex justify-between gap-x-4">
                <x-button flat label="Cancel" x-on:click="close" />
                <x-button wire:click="update" wire:loading.attr="disabled" wire:target="update" icon="check" teal
                    label="Guardar Tarea" />
            </div>
        </x-slot>
    </x-modal.card>
</div>
