<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('RF05: Inscribir Personal al Curso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('success') }}</div>
                @endif

                <form action="{{ route('asignaciones.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <x-input-label for="curso_id" :value="__('1. Seleccionar el Curso')" />
                        <select name="curso_id" id="curso_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Seleccione un curso --</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}">{{ $curso->clave }} - {{ $curso->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="buscador" :value="__('2. Buscar Personal')" />
                        <input type="text" id="buscador" onkeyup="filtrarDocentes()" placeholder="Escribe nombre, rol o departamento..." class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse" id="tablaDocentes">
                            <thead>
                                <tr class="border-b bg-gray-50">
                                    <th class="p-3 text-center">Seleccionar</th>
                                    <th class="p-3">Nombre</th>
                                    <th class="p-3">Rol</th>
                                    <th class="p-3">Departamento</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($docentes as $docente)
                                <tr class="border-b hover:bg-gray-50 docente-row">
                                    <td class="p-3 text-center">
                                        <input type="checkbox" name="docente_ids[]" value="{{ $docente->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    </td>
                                    <td class="p-3 docente-nombre">{{ $docente->nombre }} {{ $docente->apellido_paterno }}</td>
                                    <td class="p-3 docente-rol">{{ $docente->rol ?? 'Docente' }}</td>
                                    <td class="p-3 docente-depto">{{ $docente->departamento ?? 'Sin Departamento' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex items-center justify-between mt-8">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline">← Regresar</a>
                        <x-primary-button>
                            {{ __('Inscribir Personal Seleccionado') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function filtrarDocentes() {
            let input = document.getElementById('buscador').value.toLowerCase();
            let rows = document.getElementsByClassName('docente-row');

            for (let i = 0; i < rows.length; i++) {
                let text = rows[i].innerText.toLowerCase();
                if (text.includes(input)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>
</x-app-layout>