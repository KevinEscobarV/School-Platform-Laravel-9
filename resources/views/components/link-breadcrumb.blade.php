<li class="flex">
    <div class="flex items-center">
        <svg class="flex-shrink-0 w-6 h-full text-gray-200 dark:text-gray-700" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z"></path>
        </svg>
        <a {{ $attributes->merge() }} class="ml-2 sm:ml-4 text-xs sm:text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-white dark:hover:text-gray-400">{{ $name ?? $slot }}</a>
    </div>
</li>