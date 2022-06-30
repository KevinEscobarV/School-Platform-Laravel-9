<x-app-layout>

    <x-slot name="breadcrumb">
        <x-link-breadcrumb name="Inicio" href="{{ route('home') }}" />
        <x-link-breadcrumb name="Publicaciones" href="{{ route('posts.home') }}" />
        <x-link-breadcrumb name="Creacion de Publicación" />
    </x-slot>

    <div class="px-1 container mx-auto">
        <livewire:admin.post-component />
    </div>

</x-app-layout>