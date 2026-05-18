<x-app-layout>
    <x-slot name="header">Panel de Jefatura</x-slot>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
            ✓ {{ session('success') }}
        </div>
    @endif

    {{-- Título --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Panel de Jefatura</h1>
        <div class="w-12 h-1 bg-blue-600 rounded mt-2"></div>
        <p class="text-slate-500 text-sm mt-2">Bienvenido al sistema de gestión académica de LEGIÓN.</p>
    </div>

    {{-- Tarjetas --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Registrar Curso --}}
        <a href="{{ route('cursos.create') }}"
           class="group bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-lg hover:border-blue-300 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-blue-500 rounded-l-2xl"></div>
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-100 transition">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h3 class="font-bold text-slate-800 text-base mb-1">Registrar Curso</h3>
            <p class="text-slate-500 text-sm">Crea y administra los cursos disponibles en el sistema.</p>
            <div class="mt-4 flex items-center gap-1 text-blue-600 text-sm font-medium group-hover:gap-2 transition-all">
                Acceder <span>→</span>
            </div>
        </a>

        {{-- Registrar Personal --}}
        <a href="{{ route('docentes.create') }}"
           class="group bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-lg hover:border-green-300 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-green-500 rounded-l-2xl"></div>
            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-100 transition">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <h3 class="font-bold text-slate-800 text-base mb-1">Registrar Personal</h3>
            <p class="text-slate-500 text-sm">Registra y administra el personal docente y administrativo.</p>
            <div class="mt-4 flex items-center gap-1 text-green-600 text-sm font-medium group-hover:gap-2 transition-all">
                Acceder <span>→</span>
            </div>
        </a>

        {{-- Registrar Instructor --}}
        <a href="{{ route('instructores.create') }}"
           class="group bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-lg hover:border-purple-300 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-purple-500 rounded-l-2xl"></div>
            <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-100 transition">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 14l9-5-9-5-9 5 9 5z"/>
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 14l9-5-9-5-9 5 9 5zm0 0v6"/>
</svg>
            </div>
            <h3 class="font-bold text-slate-800 text-base mb-1">Registrar Instructor</h3>
            <p class="text-slate-500 text-sm">Registra y gestiona a los instructores del sistema.</p>
            <div class="mt-4 flex items-center gap-1 text-purple-600 text-sm font-medium group-hover:gap-2 transition-all">
                Acceder <span>→</span>
            </div>
        </a>

        {{-- Inscribir al Curso --}}
        <a href="{{ route('asignaciones.create') }}"
           class="group bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-lg hover:border-yellow-300 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-yellow-500 rounded-l-2xl"></div>
            <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-yellow-100 transition">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h3 class="font-bold text-slate-800 text-base mb-1">Inscribir al Curso</h3>
            <p class="text-slate-500 text-sm">Inscribe personal en los cursos disponibles.</p>
            <div class="mt-4 flex items-center gap-1 text-yellow-600 text-sm font-medium group-hover:gap-2 transition-all">
                Acceder <span>→</span>
            </div>
        </a>

        {{-- Reporte --}}
        <a href="{{ route('reportes.asistencia') }}"
           class="group bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-lg hover:border-red-300 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-red-500 rounded-l-2xl"></div>
            <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-red-100 transition">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="font-bold text-slate-800 text-base mb-1">Reporte de Personal Inscrito</h3>
            <p class="text-slate-500 text-sm">Consulta y genera reportes del personal inscrito en los cursos.</p>
            <div class="mt-4 flex items-center gap-1 text-red-600 text-sm font-medium group-hover:gap-2 transition-all">
                Acceder <span>→</span>
            </div>
        </a>

    </div>

</x-app-layout>