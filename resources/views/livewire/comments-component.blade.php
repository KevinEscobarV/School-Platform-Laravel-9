<div>
    <div class="mt-5">
        <x-card cardClasses="border" title="Comentarios">
            @forelse ($comments as $comment)
                <div>
                    <div class="header flex justify-between mb-2 text-sm text-gray-500">
                        <div class="whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-xl object-cover"
                                        src="{{ $comment->user->profile_photo_url }}"
                                        alt="{{ $comment->user->name }}">
                                </div>
                                <div class="ml-4 hidden sm:block">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $comment->user->name }}
                                        {{ $comment->user->apellido }}</div>
                                    <div class="text-sm text-gray-500">{{ $comment->user->email }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-x-3 items-center">
                            @if ($comment->created_at != $comment->updated_at)
                                <p class="flex py-1 px-2 bg-blue-50 text-blue-400 text-sm rounded-xl">
                                    <x-icon name="pencil" class="w-5 h-5 mr-2" />
                                    Editado
                                </p>
                                <p class="flex py-1 px-2 bg-orange-50 text-orange-700 text-sm rounded-xl">
                                    <x-icon name="calendar" class="w-5 h-5 mr-2" />
                                    {{ $comment->get_updated_at }}
                                </p>
                            @else
                                <p class="flex py-1 px-2 bg-orange-50 text-orange-700 text-sm rounded-xl">
                                    <x-icon name="calendar" class="w-5 h-5 mr-2" />
                                    {{ $comment->get_created_at }}
                                </p>
                            @endif
                            @auth
                                @if (Auth::user()->id == $comment->user_id)
                                <x-button wire:click="edit('{{ $comment->id }}')" outline blue rounded 2xs
                                    label="Editar" />
                                <x-button label="Eliminar" rounded red outline 2xs
                                    x-on:confirm="{
                                        title: '¿Estás seguro de eliminar este comentario?',
                                        description: 'Esta acción no se puede deshacer.',
                                        icon: 'warning',
                                        method: 'delete',
                                        params: '{{ $comment->id }}',
                                    }" />
                                @endif
                            @endauth
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-base text-gray-600 text-justify break-words">{{ $comment->comment }}</p>
                    </div>
                </div>
                <x-section-border class="mt-8 mb-4"></x-section-border>
            @empty
                <div class="text-left">
                    <p class="text-gray-600 text-lg">No hay comentarios</p>
                </div>
            @endforelse
            @if ($comments->hasPages())
                <div class="mb-4">
                    {{ $comments->links() }}
                </div>
            @endif
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-2">
                    <x-errors />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-card cardClasses="border">
                        <x-textarea wire:model="comment" placeholder="Añade un comentario" maxlength="300" />
                        <x-slot name="footer">
                            <div class="text-right">
                                @auth
                                    <x-button wire:click="save" right-icon="chat-alt" spinner="save" teal outline rounded
                                    label="Comentar" />
                                @else
                                    <button onclick="window.$wireui.confirmNotification({
                                        title: 'No estás autenticado',
                                        description: 'Debes iniciar sesión para poder añadir comentarios.',
                                        icon: 'question',
                                        accept: {
                                            label: 'Iniciar Sesión',
                                            url: '{{ route('login') }}',
                                        },
                                        reject: {
                                            label: 'Cancelar',
                                            method: 'cancel'
                                        }
                                    })">
                                        Comentar
                                    </button>
                                @endauth
                            </div>
                        </x-slot>
                    </x-card>
                </div>
            </div>
        </x-card>
    </div>
    <x-modal.card title="Editar Comentario" blur max-width="xl" wire:model.defer="open">
        <x-textarea wire:model.defer="edit_input" label="Comentario" placeholder="Tu comentario" maxlength="300" />
        <x-slot name="footer">
            <div class="flex justify-between">
                @if ($edit_comment)
                    <x-button outline negative label="Delete"
                        x-on:confirm="{
                        title: '¿Estás seguro de eliminar este comentario?',
                        description: 'Esta acción no se puede deshacer.',
                        icon: 'warning',
                        method: 'delete',
                        params: '{{ $edit_comment->id }}',
                    }" />
                    <x-button primary icon="chat-alt" label="Guardar" wire:click="update" />
                @endif
            </div>
        </x-slot>
    </x-modal.card>
</div>
