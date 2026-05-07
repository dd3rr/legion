<x-app-layout>

    <div class="p-6">
        <h1 class="text-2xl font-bold">
            Panel Docente
        </h1>

        <p>
            Bienvenido {{ auth()->user()->name }}
        </p>
    </div>

</x-app-layout>