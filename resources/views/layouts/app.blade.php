<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CamiloTics') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles
    @wireUiScripts
    
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <style>
        .ck-editor {
                --ck-border-radius: 6px;
                --ck-color-base-focus: #14b8a6;
                --ck-color-focus-border: #14b8a6;
                --ck-color-base-active: #14b8a6;
                --ck-color-base-active-focus: #14b8a6;
                --ck-color-focus-border-coordinates: #14b8a6;
                --ck-color-focus-border: hsl(var(--ck-color-focus-border-coordinates));
                /* --ck-color-focus-border: #00cea1; */
            }
        .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style>
</head>

<body class="font-sans antialiased">

    <x-dialog z-index="z-50" />
    
    <x-notifications />

    <div class="flex h-screen bg-white bg-repeat" style="background-image:url('/img/fondo3.jpg'); background-size: 600px;">

        @auth
            <x-aside />
        @endauth
        
        <div class="flex flex-col flex-1 min-h-screen overflow-x-hidden overflow-y-auto">

            @livewire('navigation-menu')

            <x-banner />
            
            @if (isset($breadcrumb))
                <x-breadcrumb>
                    {{ $breadcrumb }}
                </x-breadcrumb>
            @endif
        
            <!-- Page Heading -->
            @if (isset($header))
                <header
                    class="max-w-7xl mx-auto bg-gradient-to-r from-green-500 via-teal-500 to-indigo-500 skew-y-3 rounded-md shadow">
                    <div class="py-2 px-3 sm:px-6 lg:px-8 -skew-y-3">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <x-footer />

        </div>

    </div>

    @stack('modals')
    @livewireScripts
    @stack('scripts')

</body>

</html>
