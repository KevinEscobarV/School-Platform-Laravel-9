@props(['active'])

@php
$classes = ($active ?? false)
            ? 'animate-pulse flex items-center p-2 transition-colors bg-gradient-to-r from-teal-800 to-teal-900 text-white text-white text-white px-3 py-2 rounded-md text-sm font-medium border'
            : 'flex items-center p-2 hover:bg-teal-800 hover:text-white transition-colors bg-teal-600 text-white px-3 py-2 rounded-md text-sm font-medium border border-opacity-50';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span aria-hidden="true">
      <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        {{ $path }}
      </svg>
    </span>
    <span class="ml-2 text-sm"> {{ $slot }} </span>
</a>
