<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reporte de Personal Inscrito por Curso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                
                <div class="flex justify-between items-center mb-6 no-print">
                    <h3 class="text-lg font-bold text-gray-700">Relación de Cursos</h3>
                    <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Imprimir / Guardar PDF
                    </button>
                </div>

                @forelse($cursos as $curso)
                    <div class="mb-8 border rounded-lg overflow-hidden shadow-sm">
                        <div class="bg-gray-100 p-4 border-b">
                            <h4 class="font-bold text-lg text-indigo-700">{{ $curso->nombre }}</h4>
                            <p class="text-sm text-gray-600">Clave: {{ $curso->clave }} | Instructor: {{ $curso->instructor }}</p>
                        </div>

                        <div class="p-0">
                            <table class="w-full text-sm text-left">
                                <thead class="bg-gray-50 uppercase text-xs">
                                    <tr>
                                        <th class="p-3 border-b">Nombre del Docente</th>
                                        <th class="p-3 border-b">Departamento</th>
                                        <th class="p-3 border-b">Rol</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($curso->docentes as $docente)
                                        <tr class="border-b">
                                            <td class="p-3">{{ $docente->nombre }} {{ $docente->apellido_paterno }} {{ $docente->apellido_materno }}</td>
                                            <td class="p-3">{{ $docente->departamento ?? 'N/A' }}</td>
                                            <td class="p-3">{{ $docente->rol ?? 'Docente' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="p-4 text-center text-gray-500 italic">No hay personal inscrito en este curso.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">No hay cursos registrados.</p>
                @endforelse

                <div class="mt-4 no-print">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline">← Regresar</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print { display: none !important; }
            nav { display: none !important; }
        }
    </style>
</x-app-layout>