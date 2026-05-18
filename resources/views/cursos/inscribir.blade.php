<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inscribir Personal al Curso
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('asignaciones.store') }}" method="POST">
                    @csrf

                    {{-- Selector de curso --}}
                    <div class="mb-6">
                        <x-input-label for="curso_id" :value="__('1. Seleccionar el Curso')" />
                        <select name="curso_id" id="curso_id" required
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                            onchange="filtrarPorCurso()">
                            <option value="">-- Seleccione un curso --</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}">
                                    {{ $curso->clave }} - {{ $curso->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Buscador --}}
                    <div class="mb-4">
                        <x-input-label for="buscador" :value="__('2. Buscar Personal')" />
                        <input type="text" id="buscador" onkeyup="buscar()"
                            placeholder="Escribe nombre, rol o departamento..."
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Mensaje cuando no hay curso seleccionado --}}
                    <div id="mensajeSeleccionar" class="p-4 bg-blue-50 border border-blue-200 rounded-lg text-blue-700 text-sm mb-4">
                        ℹ Selecciona un curso para ver el personal disponible.
                    </div>

                    {{-- Mensaje cuando todos están inscritos --}}
                    <div id="mensajeTodos" class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg text-yellow-700 text-sm mb-4 hidden">
                        ✓ Todo el personal ya está inscrito en este curso.
                    </div>

                    {{-- Tabla de docentes --}}
                    <div class="overflow-x-auto hidden" id="contenedorTabla">
                        <table class="w-full text-left border-collapse" id="tablaDocentes">
                            <thead>
                                <tr class="border-b bg-gray-50">
                                    <th class="p-3 text-center">Seleccionar</th>
                                    <th class="p-3">Nombre</th>
                                    <th class="p-3">Rol</th>
                                    <th class="p-3">Departamento</th>
                                </tr>
                            </thead>
                            <tbody id="cuerpoTabla">
                                @foreach($docentes as $docente)
                                    <tr class="border-b hover:bg-gray-50 docente-row"
                                        data-id="{{ $docente->id }}"
                                        data-nombre="{{ strtolower($docente->nombre . ' ' . $docente->apellido_paterno) }}"
                                        data-rol="{{ strtolower($docente->rol ?? 'docente') }}"
                                        data-depto="{{ strtolower($docente->departamento ?? '') }}">
                                        <td class="p-3 text-center">
                                            <input type="checkbox" name="docente_ids[]"
                                                value="{{ $docente->id }}"
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        </td>
                                        <td class="p-3">{{ $docente->nombre }} {{ $docente->apellido_paterno }}</td>
                                        <td class="p-3">{{ $docente->rol ?? 'Docente' }}</td>
                                        <td class="p-3">{{ $docente->departamento ?? 'Sin Departamento' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <p id="sinResultados" class="text-center text-gray-500 italic py-4 hidden">
                            No se encontraron coincidencias.
                        </p>
                    </div>

                    <div class="flex items-center justify-between mt-8">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline">← Regresar</a>
                        <x-primary-button id="btnInscribir" class="hidden">
                            Inscribir Personal Seleccionado
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- Datos de inscritos por curso en JSON para JavaScript --}}
    <script>
        const inscritos = @json($inscritos);

        function filtrarPorCurso() {
            const cursoId         = document.getElementById('curso_id').value;
            const contenedor      = document.getElementById('contenedorTabla');
            const mensajeSelect   = document.getElementById('mensajeSeleccionar');
            const mensajeTodos    = document.getElementById('mensajeTodos');
            const btnInscribir    = document.getElementById('btnInscribir');
            const rows            = document.querySelectorAll('.docente-row');

            // Limpiar checkboxes
            document.querySelectorAll('input[name="docente_ids[]"]').forEach(cb => cb.checked = false);

            if (!cursoId) {
                contenedor.classList.add('hidden');
                mensajeSelect.classList.remove('hidden');
                mensajeTodos.classList.add('hidden');
                btnInscribir.classList.add('hidden');
                return;
            }

            mensajeSelect.classList.add('hidden');

            const yaInscritos = inscritos[cursoId] || [];
            let disponibles   = 0;

            rows.forEach(row => {
                const docenteId = parseInt(row.dataset.id);
                if (yaInscritos.includes(docenteId)) {
                    row.style.display = 'none';
                } else {
                    row.style.display = '';
                    disponibles++;
                }
            });

            if (disponibles === 0) {
                contenedor.classList.add('hidden');
                mensajeTodos.classList.remove('hidden');
                btnInscribir.classList.add('hidden');
            } else {
                contenedor.classList.remove('hidden');
                mensajeTodos.classList.add('hidden');
                btnInscribir.classList.remove('hidden');
            }
        }

        function buscar() {
            const texto   = document.getElementById('buscador').value.toLowerCase();
            const rows    = document.querySelectorAll('.docente-row');
            const cursoId = document.getElementById('curso_id').value;
            const yaInscritos = cursoId ? (inscritos[cursoId] || []) : [];
            let visibles  = 0;

            rows.forEach(row => {
                const docenteId = parseInt(row.dataset.id);
                if (yaInscritos.includes(docenteId)) {
                    row.style.display = 'none';
                    return;
                }
                const coincide = row.dataset.nombre.includes(texto) ||
                                 row.dataset.rol.includes(texto) ||
                                 row.dataset.depto.includes(texto);
                row.style.display = coincide ? '' : 'none';
                if (coincide) visibles++;
            });

            document.getElementById('sinResultados').classList.toggle('hidden', visibles > 0);
        }
    </script>
</x-app-layout>