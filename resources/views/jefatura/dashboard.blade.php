<x-app-layout>

    {{-- Encabezado --}}
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    Panel de Jefatura
                </h2>

                <p class="text-gray-500 mt-1">
                    Sistema de gestión académica LEGIÓN
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensaje de éxito --}}
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tarjetas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                {{-- Registrar Curso --}}
                <a href="{{ route('cursos.create') }}"
                   class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-8 border-l-4 border-blue-500 group">

                    <div class="flex items-center justify-between mb-6">

                        <div class="bg-blue-100 text-blue-600 p-4 rounded-2xl text-3xl">
                            📚
                        </div>

                        <span class="text-sm text-gray-400 group-hover:text-blue-500 transition">
                            Gestión Académica
                        </span>

                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-3">
                        Registrar Curso
                    </h3>

                    <p class="text-gray-500 leading-relaxed">
                        Crea y administra cursos disponibles dentro del sistema académico.
                    </p>

                    <div class="mt-6 text-blue-600 font-semibold">
                        Acceder →
                    </div>

                </a>

                {{-- Registrar Personal --}}
                <a href="{{ route('docentes.create') }}"
                   class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-8 border-l-4 border-green-500 group">

                    <div class="flex items-center justify-between mb-6">

                        <div class="bg-green-100 text-green-600 p-4 rounded-2xl text-3xl">
                            👤
                        </div>

                        <span class="text-sm text-gray-400 group-hover:text-green-500 transition">
                            Administración
                        </span>

                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-3">
                        Registrar Personal
                    </h3>

                    <p class="text-gray-500 leading-relaxed">
                        Registra docentes y personal del sistema con sus credenciales.
                    </p>

                    <div class="mt-6 text-green-600 font-semibold">
                        Acceder →
                    </div>

                </a>

                {{-- Registrar Instructor --}}
                <a href="{{ route('instructores.create') }}"
                   class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-8 border-l-4 border-purple-500 group">

                    <div class="flex items-center justify-between mb-6">

                        <div class="bg-purple-100 text-purple-600 p-4 rounded-2xl text-3xl">
                            🎓
                        </div>

                        <span class="text-sm text-gray-400 group-hover:text-purple-500 transition">
                            Capacitación
                        </span>

                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-3">
                        Registrar Instructor
                    </h3>

                    <p class="text-gray-500 leading-relaxed">
                        Administra instructores encargados de impartir los cursos.
                    </p>

                    <div class="mt-6 text-purple-600 font-semibold">
                        Acceder →
                    </div>

                </a>

                {{-- Inscribir al Curso --}}
                <a href="{{ route('asignaciones.create') }}"
                   class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-8 border-l-4 border-yellow-500 group">

                    <div class="flex items-center justify-between mb-6">

                        <div class="bg-yellow-100 text-yellow-600 p-4 rounded-2xl text-3xl">
                            📋
                        </div>

                        <span class="text-sm text-gray-400 group-hover:text-yellow-500 transition">
                            Inscripciones
                        </span>

                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-3">
                        Inscribir al Curso
                    </h3>

                    <p class="text-gray-500 leading-relaxed">
                        Inscribe personal a los cursos disponibles dentro del sistema.
                    </p>

                    <div class="mt-6 text-yellow-600 font-semibold">
                        Acceder →
                    </div>

                </a>

                {{-- Reportes --}}
                <a href="{{ route('reportes.asistencia') }}"
                   class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-8 border-l-4 border-red-500 group md:col-span-2 xl:col-span-1">

                    <div class="flex items-center justify-between mb-6">

                        <div class="bg-red-100 text-red-600 p-4 rounded-2xl text-3xl">
                            📊
                        </div>

                        <span class="text-sm text-gray-400 group-hover:text-red-500 transition">
                            Reportes
                        </span>

                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-3">
                        Reporte de Personal
                    </h3>

                    <p class="text-gray-500 leading-relaxed">
                        Consulta información y reportes del personal inscrito en cursos.
                    </p>

                    <div class="mt-6 text-red-600 font-semibold">
                        Acceder →
                    </div>

                </a>

            </div>

        </div>

    </div>

</x-app-layout>