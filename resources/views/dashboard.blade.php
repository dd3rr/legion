<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <h3 style="font-size: 1.2rem; font-weight: bold;">Cursos Registrados</h3>

                        @if(auth()->user()->role === 'jefatura')
                        <a href="{{ route('cursos.create') }}"
                            style="background-color: #2563eb; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold; text-decoration: none; font-size: 14px;">
                            + Nuevo Curso
                        </a>
                        @endif
                    </div>

                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f3f4f6;">
                                <th style="border: 1px solid #d1d5db; padding: 8px;">Clave</th>
                                <th style="border: 1px solid #d1d5db; padding: 8px;">Nombre</th>
                                <th style="border: 1px solid #d1d5db; padding: 8px;">Periodo</th>
                                <th style="border: 1px solid #d1d5db; padding: 8px;">Horario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cursos as $curso)
                            <tr>
                                <td style="border: 1px solid #d1d5db; padding: 8px; text-align: center;">{{ $curso->clave }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px;">{{ $curso->nombre }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px; text-align: center;">{{ $curso->fecha_inicio }} a {{ $curso->fecha_fin }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px; text-align: center;">{{ $curso->hora_inicio }} - {{ $curso->hora_fin }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>