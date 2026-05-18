<x-app-layout>
    <x-slot name="header">Panel del Docente</x-slot>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
            ✓ {{ session('success') }}
        </div>
    @endif

    {{-- Título --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Panel del Docente</h1>
        <div class="w-12 h-1 bg-blue-600 rounded mt-2"></div>
        <p class="text-slate-500 text-sm mt-2">
            Bienvenido, {{ $docente->nombre }} {{ $docente->apellido_paterno }}.
            {{ $docente->departamento ?? 'Sin departamento asignado' }}.
        </p>
    </div>

    {{-- Tarjetas --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Datos Académicos --}}
        <a href="#datos-academicos"
           onclick="document.getElementById('datos-academicos').scrollIntoView({behavior:'smooth'}); return false;"
           class="group bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-lg hover:border-blue-300 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-blue-500 rounded-l-2xl"></div>
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-100 transition">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <h3 class="font-bold text-slate-800 text-base mb-1">Datos Académicos</h3>
            <p class="text-slate-500 text-sm">Registra y actualiza tu información académica.</p>
            <div class="mt-4 flex items-center gap-1 text-blue-600 text-sm font-medium group-hover:gap-2 transition-all">
                Acceder <span>→</span>
            </div>
        </a>

        {{-- Mis Calificaciones --}}
        <a href="{{ route('docente.calificaciones') }}"
           class="group bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-lg hover:border-indigo-300 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-indigo-500 rounded-l-2xl"></div>
            <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-indigo-100 transition">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <h3 class="font-bold text-slate-800 text-base mb-1">Mis Calificaciones</h3>
            <p class="text-slate-500 text-sm">Consulta tus calificaciones por unidad en cada curso.</p>
            <div class="mt-4 flex items-center gap-1 text-indigo-600 text-sm font-medium group-hover:gap-2 transition-all">
                Acceder <span>→</span>
            </div>
        </a>

        {{-- Ficha Técnica --}}
        <a href="{{ route('docente.ficha-tecnica') }}"
           class="group bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-lg hover:border-green-300 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-green-500 rounded-l-2xl"></div>
            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-100 transition">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
            </div>
            <h3 class="font-bold text-slate-800 text-base mb-1">Ficha Técnica</h3>
            <p class="text-slate-500 text-sm">Genera tu ficha técnica en formato PDF.</p>
            <div class="mt-4 flex items-center gap-1 text-green-600 text-sm font-medium group-hover:gap-2 transition-all">
                Acceder <span>→</span>
            </div>
        </a>

    </div>

    {{-- Mis Cursos --}}
    <div class="mt-8 bg-white rounded-2xl border border-slate-200 p-6">
        <h3 class="text-base font-bold text-slate-800 mb-4">Mis Cursos Inscritos</h3>

        @forelse($cursos as $curso)
            <div class="flex items-center justify-between border border-slate-100 rounded-xl p-4 mb-3 hover:bg-slate-50 transition">
                <div>
                    <h4 class="font-semibold text-slate-800 text-sm">{{ $curso->nombre }}</h4>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Clave: {{ $curso->clave }} ·
                        {{ $curso->fecha_inicio }} al {{ $curso->fecha_fin }} ·
                        {{ $curso->unidades->count() }} unidades
                    </p>
                </div>
                <a href="{{ route('docente.boleta', $curso->id) }}"
                   class="text-xs font-medium text-indigo-600 hover:text-indigo-800 border border-indigo-200 px-3 py-1.5 rounded-lg hover:bg-indigo-50 transition">
                    Ver boleta
                </a>
            </div>
        @empty
            <p class="text-slate-400 italic text-sm">No estás inscrito en ningún curso aún.</p>
        @endforelse
    </div>

    {{-- Sección Datos Académicos --}}
    <div id="datos-academicos" class="mt-8 bg-white rounded-2xl border border-slate-200 p-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <h3 class="text-base font-bold text-slate-800">Datos Académicos</h3>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('docente.datos-academicos') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Grado de Estudios *</label>
                    <select name="grado_academico" required
                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Selecciona --</option>
                        @foreach(['Licenciatura','Ingeniería','Maestría','Doctorado','Técnico Superior','Bachillerato'] as $grado)
                            <option value="{{ $grado }}"
                                {{ old('grado_academico', $docente->grado_academico) == $grado ? 'selected' : '' }}>
                                {{ $grado }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Carrera *</label>
                    <input type="text" name="carrera" required
                        value="{{ old('carrera', $docente->carrera) }}"
                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Ej: Ingeniería en Sistemas" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Departamento *</label>
                    <input type="text" name="departamento" required
                        value="{{ old('departamento', $docente->departamento) }}"
                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Ej: Tecnologías de la Información" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Rol *</label>
                    <select name="rol" required
                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Selecciona --</option>
                        @foreach(['Docente','Coordinador','Jefe de Área','Subdirector','Director'] as $r)
                            <option value="{{ $r }}"
                                {{ old('rol', $docente->rol) == $r ? 'selected' : '' }}>
                                {{ $r }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Especialidad</label>
                    <input type="text" name="especialidad"
                        value="{{ old('especialidad', $docente->especialidad) }}"
                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Opcional" />
                </div>

            </div>

            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
                    Guardar Datos Académicos
                </button>
            </div>
        </form>
    </div>

</x-app-layout>