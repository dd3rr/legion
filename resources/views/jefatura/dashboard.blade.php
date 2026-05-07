<x-app-layout>

    <div class="p-6">

        <h1 class="text-3xl font-bold mb-6">
            Panel de Jefatura
        </h1>

        <div class="grid grid-cols-2 gap-6">

            <a href="{{ route('cursos.create') }}"
               class="bg-blue-500 text-white p-6 rounded-lg text-center font-bold hover:bg-blue-600">

                Registrar Curso

            </a>

            <a href="#"
               class="bg-green-500 text-white p-6 rounded-lg text-center font-bold hover:bg-green-600">

                Registrar Personal

            </a>

            <a href="#"
               class="bg-yellow-500 text-white p-6 rounded-lg text-center font-bold hover:bg-yellow-600">

                Inscribir al Curso

            </a>

            <a href="#"
               class="bg-red-500 text-white p-6 rounded-lg text-center font-bold hover:bg-red-600">

                Reporte de Asistencia

            </a>

        </div>

    </div>

</x-app-layout>