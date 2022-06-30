<x-app-layout>
    
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name}}
        </h2>
    </x-slot> --}}

    <x-slot name="breadcrumb">
        <x-link-breadcrumb name="Administrador" href="#" />
        <x-link-breadcrumb name="Gestion de Usuarios" href="{{ route('admin.users') }}" />
        <x-link-breadcrumb name="{{$user->name}}" href="{{route('admin.profile.show', $user)}}" />
    </x-slot>
    
    <div>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

                @livewire('admin.user-edit', ['user' => $user], key('user-edit-'.$user->id))

                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('admin.user-data', ['user' => $user], key('user-data-'.$user->id))
                </div>

                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('admin.user-password', ['user' => $user], key('user-reset-password-'.$user->id))
                </div>
                
                <x-jet-section-border />

        </div>
    </div>
</x-app-layout>