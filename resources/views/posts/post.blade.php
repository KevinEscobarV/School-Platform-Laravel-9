<x-app-layout>

    <x-slot name="breadcrumb">
        <x-link-breadcrumb name="Publicaciones" href="{{ route('posts.home') }}" />
        <x-link-breadcrumb name="{{ $post->title }}" href="{{ route('posts.detail', $post->slug) }}" />
    </x-slot>

    <div class="max-w-7xl mx-auto px-1">
        <x-card cardClasses="border">
            <x-slot name="title">
                <div class="whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-xl object-cover" src="{{ $post->user->profile_photo_url }}"
                                alt="{{ $post->user->name }}">
                        </div>
                        <div class="ml-4 hidden sm:block">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $post->user->name }}
                                {{ $post->user->apellido }}</div>
                            <div class="text-sm text-gray-500">{{ $post->user->email }}</div>
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="action">
                <div class="flex gap-x-3">
                    <p class="flex py-1 px-2 bg-indigo-100 text-indigo-700 text-sm rounded-xl">
                        <x-icon name="tag" class="w-5 h-5 mr-2" />
                        {{ $post->category->name }}
                    </p>
                    <p class="flex py-1 px-2 bg-orange-100 text-orange-700 text-sm rounded-xl">
                        <x-icon name="calendar" class="w-5 h-5 mr-2" />
                        {{ $post->get_created_at }}
                    </p>
                </div>
            </x-slot>
            <div>
                <textarea id="editorRead">
                        {!! $post->body !!}
                    </textarea>
            </div>
        </x-card>

        <livewire:comments-component :post="$post" :wire:key="'post-comments-'.$post->id">
        
    </div>
    
    @push('scripts')
        <style type="text/css">
            .ck-editor {
                --ck-color-base-border: #ffffff;
            }
        </style>
        <script>
            ClassicEditor
                .create(document.querySelector('#editorRead'))
                .then(function(editor) {

                    const toolbarElement = editor.ui.view.toolbar.element;

                    affectsData = 'false';
                    editor.isReadOnly = 'true';
                    toolbarElement.style.display = 'none';

                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush

</x-app-layout>
