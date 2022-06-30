<x-app-layout>

    <x-slot name="breadcrumb">
        <a href="#" class="hidden sm:block hover:text-gray-900">
            Elements
        </a>
        <svg width="24" height="24" fill="none" class="hidden sm:block flex-none text-gray-300">
            <path d="M10.75 8.75l3.5 3.25-3.5 3.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round"></path>
        </svg>
        <a href="#" class="truncate hover:text-gray-700">
            Dropdowns
        </a>
    </x-slot>

    


    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               
                <x-jet-welcome />
                
            </div>
        </div>
    </div>
</x-app-layout>
