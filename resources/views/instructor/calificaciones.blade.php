<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Calificaciones — {{ $curso->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                        @foreach($errors->all() as $e)
                            <p>{{ $e }}</p>
                        @endforeach
                    </div>
                @endif

                {{-- Info del curso --}}
                <div class="mb-6 flex items-start justify-between flex-wrap gap-4">
                    <div>
                        <h3 class="font-bold text-gray-800 text-lg">{{ $curso->nombre }}</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Clave: <strong>{{ $curso->clave }}</strong> ·
                            Periodo: {{ $curso->fecha_inicio }} al {{ $curso->fecha_fin }} ·
                            Horario: {{ $curso->hora_inicio }} - {{ $curso->hora_fin }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $curso->docentes->count() }} participante(s) ·
                            {{ $curso->unidades->count() }} unidad(es)
                        </p>
                    </div>
                    <a href="{{ route('instructor.dashboard') }}"
                        class="text-gray-600 hover:underline text-sm">
                        ← Regresar
                    </a>
                </div>

                @if($curso->docentes->isEmpty())
                    <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg text-yellow-700 text-sm">
                        ⚠ No hay participantes inscritos en este curso todavía.
                    </div>
                @elseif($curso->unidades->isEmpty())
                    <div class="p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
                        ⚠ Este curso no tiene unidades definidas. Contacta a jefatura.
                    </div>
                @else

                <form action="{{ route('instructor.calificaciones.store', $curso->id) }}"
                      method="POST" id="formCalif">
                    @csrf

                    {{-- Leyenda --}}
                    <div class="flex items-center gap-6 mb-4 text-xs text-gray-500 flex-wrap">
                        <span class="flex items-center gap-1">
                            <span class="inline-block w-3 h-3 rounded-full bg-red-400"></span>
                            Reprobatorio (&lt; 60)
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="inline-block w-3 h-3 rounded-full bg-green-400"></span>
                            Aprobatorio (≥ 60)
                        </span>
                        <span>· Usa <kbd class="px-1 py-0.5 bg-gray-100 border rounded text-xs">Tab</kbd>
                            / flechas del teclado para moverte entre celdas</span>
                    </div>

                    {{-- Tabla estilo Excel --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full border-collapse text-sm" id="tablaCalif">
                            <thead>
                                <tr class="bg-indigo-700 text-white">
                                    <th class="px-4 py-3 text-left font-semibold border border-indigo-600 min-w-[220px] sticky left-0 bg-indigo-700 z-10">
                                        Participante
                                    </th>
                                    @foreach($curso->unidades as $unidad)
                                        <th class="px-3 py-3 text-center font-semibold border border-indigo-600 min-w-[130px]">
                                            <span class="block">U{{ $unidad->numero_unidad }}</span>
                                            <span class="block text-xs font-normal opacity-80 mt-0.5">
                                                {{ $unidad->nombre }}
                                            </span>
                                        </th>
                                    @endforeach
                                    <th class="px-3 py-3 text-center font-semibold border border-indigo-600 min-w-[100px] bg-indigo-900">
                                        Promedio
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($curso->docentes as $i => $docente)
                                    <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-indigo-50 transition-colors docente-row"
                                        data-cols="{{ $curso->unidades->count() }}">

                                        {{-- Nombre del participante --}}
                                        <td class="px-4 py-2 border border-gray-200 font-medium text-gray-800 sticky left-0 {{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                                            {{ $docente->nombre }}
                                            {{ $docente->apellido_paterno }}
                                            {{ $docente->apellido_materno }}
                                        </td>

                                        {{-- Celdas de calificación --}}
                                        @foreach($curso->unidades as $unidad)
                                            @php
                                                $val = $calificaciones[$docente->id][$unidad->id]->calificacion ?? '';
                                            @endphp
                                            <td class="px-1 py-1 border border-gray-200 text-center">
                                                <input
                                                    type="number"
                                                    name="calificaciones[{{ $docente->id }}][{{ $unidad->id }}]"
                                                    value="{{ $val }}"
                                                    min="0" max="100" step="0.01"
                                                    placeholder="—"
                                                    class="calificacion-input w-full text-center rounded py-1.5 text-sm
                                                           border border-transparent bg-transparent
                                                           focus:outline-none focus:border-indigo-400 focus:bg-white focus:ring-1 focus:ring-indigo-400
                                                           {{ $val !== '' && $val < 60 ? 'text-red-600 font-semibold' : 'text-gray-800' }}"
                                                    onchange="recalcularPromedio(this)"
                                                    onkeydown="navegarCelda(event, this)"
                                                />
                                            </td>
                                        @endforeach

                                        {{-- Promedio --}}
                                        @php
                                            $valsRow = collect($curso->unidades)->map(function($u) use ($calificaciones, $docente) {
                                                return $calificaciones[$docente->id][$u->id]->calificacion ?? null;
                                            })->filter(fn($v) => $v !== null);
                                            $promRow = $valsRow->count() > 0 ? round($valsRow->avg(), 1) : null;
                                        @endphp
                                        <td class="px-3 py-2 border border-gray-200 text-center font-bold promedio-celda bg-indigo-50">
                                            <span class="{{ $promRow !== null && $promRow < 60 ? 'text-red-600' : 'text-indigo-700' }}">
                                                {{ $promRow ?? '—' }}
                                            </span>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button class="px-8 py-3">
                            💾 Guardar Calificaciones
                        </x-primary-button>
                    </div>

                </form>
                @endif

            </div>
        </div>
    </div>

    <script>
        function recalcularPromedio(input) {
            const row    = input.closest('tr');
            const inputs = row.querySelectorAll('.calificacion-input');
            let suma = 0, count = 0;

            inputs.forEach(i => {
                const v = parseFloat(i.value);
                if (!isNaN(v)) {
                    suma += v;
                    count++;
                }
                // Color en tiempo real
                if (!isNaN(v) && v < 60) {
                    i.classList.add('text-red-600', 'font-semibold');
                    i.classList.remove('text-gray-800');
                } else {
                    i.classList.remove('text-red-600', 'font-semibold');
                    i.classList.add('text-gray-800');
                }
            });

            const span = row.querySelector('.promedio-celda span');
            if (count > 0) {
                const prom = (suma / count).toFixed(1);
                span.textContent = prom;
                span.className   = parseFloat(prom) < 60 ? 'text-red-600' : 'text-indigo-700';
            } else {
                span.textContent = '—';
                span.className   = 'text-indigo-700';
            }
        }

        function navegarCelda(event, input) {
            const teclas = ['Tab','Enter','ArrowRight','ArrowLeft','ArrowUp','ArrowDown'];
            if (!teclas.includes(event.key)) return;
            event.preventDefault();

            const todos = Array.from(document.querySelectorAll('.calificacion-input'));
            const idx   = todos.indexOf(input);
            const cols  = parseInt(input.closest('tr').dataset.cols);
            let next    = null;

            if      (event.key === 'Tab' || event.key === 'ArrowRight' || event.key === 'Enter') next = todos[idx + 1];
            else if (event.key === 'ArrowLeft')  next = todos[idx - 1];
            else if (event.key === 'ArrowDown')  next = todos[idx + cols];
            else if (event.key === 'ArrowUp')    next = todos[idx - cols];

            if (next) { next.focus(); next.select(); }
        }
    </script>
</x-app-layout>