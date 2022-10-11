<aside class="flex-shrink-0 hidden w-56 bg-gray-50 shadow md:block z-40">

    <div class="flex flex-col h-full">

      <div class="flex items-center justify-center w-full h-14 shadow">
        <div class="text-2xl  font-extrabold leading-none tracking-tight text-center">
          <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-500 to-violet-500">
            CAMILOTICS
          </span>
        </div>
      </div>

      <!-- Sidebar links -->
      <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">

        @role('Estudiante')
        <x-aside-link href="{{route('estudiante.asignaturas')}}" :active="request()->routeIs('estudiante.asignaturas')">
          <x-slot name="path">
            <path d="M12 14l9-5-9-5-9 5 9 5z" />
            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
          </x-slot>
          Mis Asignaturas
        </x-aside-link>

        <x-aside-link href="{{route('estudiante.calendario')}}" :active="request()->routeIs('estudiante.calendario')">
          <x-slot name="path">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </x-slot>
          Calendario
        </x-aside-link>

        <x-aside-link href="" :active="request()->routeIs('mihorario')">
          <x-slot name="path">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </x-slot>
          Mi Horario
        </x-aside-link>

        <x-aside-link href="" :active="request()->routeIs('misnotas')">
          <x-slot name="path">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
          </x-slot>
          Mis Calificaciones
        </x-aside-link>
        @endrole

        @role('Profesor')
        <x-aside-link href="{{route('profesor.index')}}" :active="request()->routeIs('profesor.index')">
          <x-slot name="path">
            <path d="M12 14l9-5-9-5-9 5 9 5z" />
            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
          </x-slot>
          Administración
        </x-aside-link>
        @endrole

        @role('Administrador')
        <x-aside-link href="{{route('admin.asignaturas.index')}}" :active="request()->routeIs('admin.asignaturas.index')">
          <x-slot name="path">
            <path d="M12 14l9-5-9-5-9 5 9 5z" />
            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
          </x-slot>
          Gestion de Asignaturas
        </x-aside-link>
        @endrole

        {{-- <x-aside-dropdown>
          <x-slot name="path">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
          </x-slot>

          Gestion

          <x-slot name="content">
            <x-aside-dropdown-link href="{{ route('login') }}">
              Usuarios
            </x-aside-dropdown-link>
            <x-aside-dropdown-link href="{{ route('login') }}">
              Roles
            </x-aside-dropdown-link>
            <x-aside-dropdown-link href="{{ route('login') }}">
              Registros
            </x-aside-dropdown-link>

          </x-slot>
        </x-aside-dropdown> --}}

      </nav>

      <!-- Sidebar footer -->
      <div class="flex-shrink-0 px-2 py-4 space-y-2">
        <a href="#" class="flex items-center justify-center w-full px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary-dark focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
          <span aria-hidden="true">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
          </span>
          <span>Inicio</span>
        </a>
      </div>
    </div>
  </aside>
