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
                    <div class="p-6 text-gray-900">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold">Cursos Registrados</h3>
        <a href="{{ route('cursos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Nuevo Curso
        </a>
    </div>

    <table class="min-w-full table-auto border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Clave</th>
                <th class="border p-2">Nombre</th>
                <th class="border p-2">Periodo</th>
                <th class="border p-2">Horario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $curso)
            <tr>
                <td class="border p-2 text-center">{{ $curso->clave }}</td>
                <td class="border p-2">{{ $curso->nombre }}</td>
                <td class="border p-2 text-center">{{ $curso->fecha_inicio }} a {{ $curso->fecha_fin }}</td>
                <td class="border p-2 text-center">{{ $curso->hora_inicio }} - {{ $curso->hora_fin }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
