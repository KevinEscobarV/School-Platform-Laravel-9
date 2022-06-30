<div x-data="{ isActive: false, open: false}">
    <!-- active & hover classes 'bg-primary-100 ' -->
    
    <a href="#" @click="$event.preventDefault(); open = !open" class="flex items-center p-2 text-white transition-colors rounded-md hover:bg-teal-600 border" :class="{'bg-teal-900': isActive || open}" role="button" aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'" aria-expanded="true">
      <span aria-hidden="true">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">

          {{ $path }}

        </svg>
      </span>
      <span class="ml-2 text-sm">

        {{ $slot }}

      </span>
      <span class="ml-auto" aria-hidden="true">
        <!-- active class 'rotate-180' -->
        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </span>
    </a>
    <div role="menu" x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="mt-2 space-y-2 px-7" aria-label="Dashboards" style="display: none;">
     
      {{ $content }}

    </div>
</div>