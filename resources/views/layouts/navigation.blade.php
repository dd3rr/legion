<nav x-data="{ open: false }" class="bg-slate-900 border-b border-slate-700 shadow-lg">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            {{-- Logo --}}
            <div class="flex items-center">

                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-md">
                        L
                    </div>

                    <div class="flex flex-col leading-tight">
                        <span class="text-white font-extrabold text-2xl tracking-wide uppercase italic">
                            Legión
                        </span>

                        <span class="text-slate-400 text-xs tracking-widest uppercase">
                            Sistema Académico
                        </span>
                    </div>

                </a>

            </div>

            {{-- Menú dinámico según rol --}}
            <div class="hidden sm:flex sm:items-center sm:space-x-8">

                {{-- JEFATURA --}}
                @if(Auth::user()->role === 'jefatura')

                    <x-nav-link
                        :href="route('jefatura.dashboard')"
                        :active="request()->routeIs('jefatura.dashboard')"
                        class="text-slate-300 hover:text-white hover:border-blue-500 transition">
                        {{ __('Inicio') }}
                    </x-nav-link>

                    <x-nav-link
                        :href="route('cursos.create')"
                        :active="request()->routeIs('cursos.*')"
                        class="text-slate-300 hover:text-white hover:border-blue-500 transition">
                        {{ __('Cursos') }}
                    </x-nav-link>

                    <x-nav-link
                        :href="route('docentes.create')"
                        :active="request()->routeIs('docentes.*')"
                        class="text-slate-300 hover:text-white hover:border-blue-500 transition">
                        {{ __('Personal') }}
                    </x-nav-link>

                    <x-nav-link
                        :href="route('asignaciones.create')"
                        :active="request()->routeIs('asignaciones.*')"
                        class="text-slate-300 hover:text-white hover:border-blue-500 transition">
                        {{ __('Inscripciones') }}
                    </x-nav-link>

                @endif


                {{-- DOCENTE --}}
                @if(Auth::user()->role === 'docente')

                    <x-nav-link
                        :href="route('docente.dashboard')"
                        :active="request()->routeIs('docente.dashboard')"
                        class="text-slate-300 hover:text-white hover:border-blue-500 transition">
                        {{ __('Inicio') }}
                    </x-nav-link>

                    <x-nav-link
                        :href="route('docente.calificaciones')"
                        :active="request()->routeIs('docente.calificaciones')"
                        class="text-slate-300 hover:text-white hover:border-blue-500 transition">
                        {{ __('Calificaciones') }}
                    </x-nav-link>

                    <x-nav-link
                        :href="route('docente.ficha-tecnica')"
                        :active="request()->routeIs('docente.ficha-tecnica')"
                        class="text-slate-300 hover:text-white hover:border-blue-500 transition">
                        {{ __('Ficha Técnica') }}
                    </x-nav-link>

                @endif


                {{-- INSTRUCTOR --}}
                @if(Auth::user()->role === 'instructor')

                    <x-nav-link
                        :href="route('instructor.dashboard')"
                        :active="request()->routeIs('instructor.dashboard')"
                        class="text-slate-300 hover:text-white hover:border-blue-500 transition">
                        {{ __('Inicio') }}
                    </x-nav-link>

                @endif

            </div>

            {{-- Usuario --}}
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-slate-800 text-slate-300 hover:text-white hover:bg-slate-700 transition duration-200">

                            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <div class="text-sm font-medium">
                                {{ Auth::user()->name }}
                            </div>

                            <svg class="fill-current h-4 w-4"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">

                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd" />

                            </svg>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <div class="px-4 py-2 border-b border-slate-200">
                            <p class="text-sm font-semibold text-slate-700">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-slate-500">
                                {{ Auth::user()->email }}
                            </p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Mi Perfil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                         this.closest('form').submit();">

                                {{ __('Cerrar Sesión') }}

                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            {{-- Botón responsive --}}
            <div class="-mr-2 flex items-center sm:hidden">

                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-800 transition">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">

                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>

    {{-- Menú móvil --}}
    <div :class="{'block': open, 'hidden': ! open}"
         class="hidden sm:hidden bg-slate-800 border-t border-slate-700">

        <div class="pt-2 pb-3 space-y-1">

            {{-- JEFATURA --}}
            @if(Auth::user()->role === 'jefatura')

                <x-responsive-nav-link
                    :href="route('jefatura.dashboard')"
                    :active="request()->routeIs('jefatura.dashboard')">
                    {{ __('Inicio') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('cursos.create')"
                    :active="request()->routeIs('cursos.*')">
                    {{ __('Cursos') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('docentes.create')"
                    :active="request()->routeIs('docentes.*')">
                    {{ __('Personal') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('asignaciones.create')"
                    :active="request()->routeIs('asignaciones.*')">
                    {{ __('Inscripciones') }}
                </x-responsive-nav-link>

            @endif


            {{-- DOCENTE --}}
            @if(Auth::user()->role === 'docente')

                <x-responsive-nav-link
                    :href="route('docente.dashboard')"
                    :active="request()->routeIs('docente.dashboard')">
                    {{ __('Inicio') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('docente.calificaciones')"
                    :active="request()->routeIs('docente.calificaciones')">
                    {{ __('Calificaciones') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('docente.ficha-tecnica')"
                    :active="request()->routeIs('docente.ficha-tecnica')">
                    {{ __('Ficha Técnica') }}
                </x-responsive-nav-link>

            @endif

        </div>

        {{-- Datos usuario móvil --}}
        <div class="pt-4 pb-3 border-t border-slate-700">

            <div class="px-4">

                <div class="font-medium text-base text-white">
                    {{ Auth::user()->name }}
                </div>

                <div class="font-medium text-sm text-slate-400">
                    {{ Auth::user()->email }}
                </div>

            </div>

            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Mi Perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault();
                                 this.closest('form').submit();">

                        {{ __('Cerrar Sesión') }}

                    </x-responsive-nav-link>

                </form>

            </div>

        </div>

    </div>

</nav>