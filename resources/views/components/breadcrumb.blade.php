<nav class="bg-white border-b border-gray-200 flex dark:bg-gray-800 dark:border-gray-700 mb-5 sm:sticky sm:top-14 z-30" aria-label="Breadcrumb">
    <ol role="list" class="max-w-screen-xl w-full mx-auto px-4 flex space-x-2 sm:space-x-4 sm:px-6 lg:px-8">
        <li class="flex">
            <div class="flex items-center">
                <a href="{{route('home')}}" class="text-gray-400 hover:text-gray-500 dark:text-white dark:hover:text-gray-400">
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    <span class="sr-only">Inicio</span>
                </a>
            </div>
        </li>
        {{$slot}}
    </ol>
</nav>