<x-app-layout>

    <x-slot name="breadcrumb">
        <x-link-breadcrumb name="Publicaciones" href="{{ route('posts.home') }}" />
    </x-slot>

    <div class="container px-5 py-6 mx-auto">
        {{-- <x-button-link value="Crear una Publicación" class="w-full"  /> --}}
        <a href="{{ route('admin.post.create') }}"
            class="relative group block max-w-full mx-auto rounded-lg p-4 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-green-500 border-2 border-green-500">
            <div class="flex items-center space-x-3">
                <svg class="group-hover:animate-pulse h-9 w-9 stroke-sky-800 group-hover:stroke-white" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                <h3 class="text-sm text-slate-900 font-semibold group-hover:text-white">Crear Nueva Publicación</h3>
            </div>
            <p class="text-sm text-slate-500 group-hover:text-white">Puedes realizar a travez de un formulario una
                publicacion para ser mostrada al publico.</p>
        </a>
    </div>

    <div class="container px-5 py-6 mx-auto">
        <div class="grid grid-cols-6 gap-6">
            @foreach ($posts as $post)
                <div class="col-span-6 sm:col-span-3">
                    <div class="p-4 flex flex-col items-start bg-white rounded-md shadow-md border-2 border-gray-300">
                        <span class="inline-block py-1 px-2 rounded bg-teal-100 text-teal-800 text-sm font-medium tracking-widest uppercase">{{$post->category->name}}</span>
                        <h2 class="sm:text-3xl text-2xl title-font font-medium text-gray-900 mt-4 mb-4">
                            {{ $post->title }}</h2>
                        {{-- <div>
                            <p class="leading-relaxed mb-8">{!! $post->getLimitBody !!}</p>
                        </div> --}}
                        <div class="flex items-center flex-wrap pb-4 mb-4 border-b-2 border-gray-100 mt-auto w-full">
                            <a href="{{ route('posts.detail', $post->slug) }}"
                                class="text-indigo-500 inline-flex items-center">{{ __('Learn More') }}
                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            <span
                                class="text-gray-400 mr-3 inline-flex items-center ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>{{ $post->get_created_at }}
                            </span>
                            <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path
                                        d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z">
                                    </path>
                                </svg>{{ $post->comments->count() }}
                            </span>
                        </div>
                        <a class="inline-flex items-center">
                            <img alt="{{ $post->user->name }}" src="{{ $post->user->profile_photo_url }}"
                                class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                            <span class="flex-grow flex flex-col pl-4">
                                <span class="title-font font-medium text-gray-900">{{ $post->user->name }}</span>
                                <span
                                    class="text-gray-400 text-xs tracking-widest mt-0.5">{{ $post->user->email }}</span>
                            </span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-gray-100 px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $posts->links() }}
    </div>

</x-app-layout>
