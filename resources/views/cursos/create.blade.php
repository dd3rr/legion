<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Nuevo Curso
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('cursos.store') }}" method="POST" id="formCurso">
                    @csrf

                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Datos del Curso</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <x-input-label for="nombre" :value="__('Nombre del Curso')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text"
                                name="nombre" value="{{ old('nombre') }}" required />
                        </div>

                        <div>
                            <x-input-label for="fecha_inicio" :value="__('Fecha de Inicio')" />
                            <x-text-input id="fecha_inicio" class="block mt-1 w-full" type="date"
                                name="fecha_inicio" value="{{ old('fecha_inicio') }}" required />
                        </div>

                        <div>
                            <x-input-label for="fecha_fin" :value="__('Fecha de Término')" />
                            <x-text-input id="fecha_fin" class="block mt-1 w-full" type="date"
                                name="fecha_fin" value="{{ old('fecha_fin') }}" required />
                        </div>

                        <div>
                            <x-input-label for="hora_inicio" :value="__('Hora de Inicio')" />
                            <x-text-input id="hora_inicio" class="block mt-1 w-full" type="time"
                                name="hora_inicio" value="{{ old('hora_inicio') }}" required />
                        </div>

                        <div>
                            <x-input-label for="hora_fin" :value="__('Hora de Fin')" />
                            <x-text-input id="hora_fin" class="block mt-1 w-full" type="time"
                                name="hora_fin" value="{{ old('hora_fin') }}" required />
                        </div>

                        <div>
                            <x-input-label for="instructor_id" :value="__('Instructor')" />
                            <select id="instructor_id" name="instructor_id" required
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                                <option value="">-- Selecciona un instructor --</option>
                                @foreach ($instructores as $instructor)
                                    <option value="{{ $instructor->id }}"
                                        {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                        {{ $instructor->nombre }} {{ $instructor->apellido_paterno }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    {{-- Unidades dinámicas --}}
                    <div class="mt-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Unidades del Curso</h3>
                            <button type="button" id="btnAgregarUnidad"
                                class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700">
                                + Agregar Unidad
                            </button>
                        </div>

                        <div id="contenedorUnidades" class="space-y-3"></div>

                        <p id="sinUnidades" class="text-sm text-red-500 mt-2 hidden">
                            Debes agregar al menos una unidad.
                        </p>
                    </div>

                    <div class="flex items-center justify-between mt-8">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline">← Regresar</a>
                        <x-primary-button>Guardar Curso</x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        let contador = 0;

        function agregarUnidad() {
            const idx        = contador++;
            const contenedor = document.getElementById('contenedorUnidades');
            const num        = contenedor.children.length + 1;
            const div        = document.createElement('div');

            div.className = 'border border-gray-200 rounded-lg p-4 bg-gray-50 unidad-item';
            div.innerHTML = `
                <div class="flex items-center justify-between mb-3">
                    <span class="font-semibold text-gray-700 text-sm">Unidad ${num}</span>
                    <button type="button" onclick="eliminarUnidad(this)"
                        class="text-red-500 text-sm hover:underline">Eliminar</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre *</label>
                        <input type="text" name="unidades[${idx}][nombre]" required
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm text-sm"
                            placeholder="Ej: Introducción al tema" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <input type="text" name="unidades[${idx}][descripcion]"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm text-sm"
                            placeholder="Opcional" />
                    </div>
                </div>
            `;
            contenedor.appendChild(div);
            renumerar();
        }

        function eliminarUnidad(btn) {
            btn.closest('.unidad-item').remove();
            renumerar();
        }

        function renumerar() {
            document.querySelectorAll('.unidad-item').forEach((item, i) => {
                item.querySelector('span').textContent = `Unidad ${i + 1}`;
            });
        }

        document.getElementById('btnAgregarUnidad').addEventListener('click', agregarUnidad);

        document.getElementById('formCurso').addEventListener('submit', function (e) {
            if (document.querySelectorAll('.unidad-item').length === 0) {
                e.preventDefault();
                document.getElementById('sinUnidades').classList.remove('hidden');
            }
        });

        agregarUnidad();
    </script>
</x-app-layout>