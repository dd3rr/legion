<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mis Calificaciones
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @forelse($cursos as $curso)
                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">

                    {{-- Encabezado del curso --}}
                    <div class="bg-indigo-600 px-6 py-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-white font-bold text-lg">{{ $curso->nombre }}</h3>
                            <p class="text-indigo-200 text-sm">
                                Clave: {{ $curso->clave }} ·
                                {{ $curso->fecha_inicio }} al {{ $curso->fecha_fin }}
                            </p>
                        </div>

                        {{-- Botón boleta solo si tiene todas las calificaciones --}}
                        @php
                            $totalUnidades  = $curso->unidades->count();
                            $totalCalifs    = collect($curso->unidades)->filter(
                                fn($u) => isset($mapa[$curso->id][$u->id])
                            )->count();
                            $completo = $totalUnidades > 0 && $totalCalifs === $totalUnidades;
                        @endphp

                        @if($completo)
                            <a href="{{ route('docente.boleta', $curso->id) }}"
                               class="bg-white text-indigo-600 px-4 py-2 rounded-md text-sm font-bold hover:bg-indigo-50 transition">
                                🖨 Generar Boleta PDF
                            </a>
                        @else
                            <span class="text-indigo-200 text-xs italic">
                                Boleta disponible cuando estén todas las calificaciones
                            </span>
                        @endif
                    </div>

                    {{-- Tabla de calificaciones --}}
                    <div class="p-6">
                        @if($curso->unidades->isEmpty())
                            <p class="text-gray-500 italic text-sm">Este curso no tiene unidades registradas.</p>
                        @else
                            <table class="w-full text-sm border-collapse">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="border border-gray-200 px-4 py-2 text-left">Unidad</th>
                                        <th class="border border-gray-200 px-4 py-2 text-left">Nombre</th>
                                        <th class="border border-gray-200 px-4 py-2 text-center">Calificación</th>
                                        <th class="border border-gray-200 px-4 py-2 text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($curso->unidades as $unidad)
                                        @php
                                            $calificacion = $mapa[$curso->id][$unidad->id] ?? null;
                                            $aprobado     = $calificacion !== null && $calificacion >= 60;
                                        @endphp
                                        <tr class="hover:bg-gray-50">
                                            <td class="border border-gray-200 px-4 py-2 text-center font-bold text-gray-600">
                                                {{ $unidad->numero_unidad }}
                                            </td>
                                            <td class="border border-gray-200 px-4 py-2">
                                                {{ $unidad->nombre }}
                                            </td>
                                            <td class="border border-gray-200 px-4 py-2 text-center font-bold text-lg
                                                {{ $calificacion === null ? 'text-gray-400' : ($aprobado ? 'text-green-600' : 'text-red-600') }}">
                                                {{ $calificacion ?? '—' }}
                                            </td>
                                            <td class="border border-gray-200 px-4 py-2 text-center">
                                                @if($calificacion === null)
                                                    <span class="bg-gray-100 text-gray-500 px-2 py-1 rounded-full text-xs">Pendiente</span>
                                                @elseif($aprobado)
                                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Aprobado</span>
                                                @else
                                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Reprobado</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @if($totalUnidades > 0 && $totalCalifs > 0)
                                    <tfoot>
                                        <tr class="bg-indigo-50">
                                            <td colspan="2" class="border border-gray-200 px-4 py-2 font-bold text-right text-gray-700">
                                                Promedio General
                                            </td>
                                            @php
                                                $vals = collect($curso->unidades)
                                                    ->map(fn($u) => $mapa[$curso->id][$u->id] ?? null)
                                                    ->filter(fn($v) => $v !== null);
                                                $prom = $vals->count() > 0 ? round($vals->avg(), 1) : null;
                                            @endphp
                                            <td class="border border-gray-200 px-4 py-2 text-center font-bold text-lg
                                                {{ $prom !== null && $prom >= 60 ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $prom ?? '—' }}
                                            </td>
                                            <td class="border border-gray-200 px-4 py-2 text-center">
                                                @if($prom !== null)
                                                    @if($prom >= 60)
                                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Aprobado</span>
                                                    @else
                                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Reprobado</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        @endif
                    </div>

                </div>
            @empty
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <p class="text-gray-500 italic">No estás inscrito en ningún curso.</p>
                </div>
            @endforelse

            <div class="mt-2">
                <a href="{{ route('docente.dashboard') }}" class="text-gray-600 hover:underline">← Regresar</a>
            </div>

        </div>
    </div>
</x-app-layout>