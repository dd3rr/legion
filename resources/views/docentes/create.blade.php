<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Nuevo Docente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('docentes.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <!-- Nombre -->
    <div>
        <x-input-label for="nombre" :value="__('Nombre(s)')" />
        <x-text-input id="nombre" class="block mt-1 w-full"
            type="text"
            name="nombre"
            required />
    </div>

    <!-- Apellido paterno -->
    <div>
        <x-input-label for="apellido_paterno" :value="__('Apellido Paterno')" />
        <x-text-input id="apellido_paterno" class="block mt-1 w-full"
            type="text"
            name="apellido_paterno"
            required />
    </div>

    <!-- Apellido materno -->
    <div>
        <x-input-label for="apellido_materno" :value="__('Apellido Materno')" />
        <x-text-input id="apellido_materno" class="block mt-1 w-full"
            type="text"
            name="apellido_materno"
            required />
    </div>

    <!-- CURP -->
    <div>
        <x-input-label for="curp" :value="__('CURP')" />
        <x-text-input id="curp" class="block mt-1 w-full"
            type="text"
            name="curp"
            required />
    </div>

    <!-- RFC -->
    <div>
        <x-input-label for="rfc" :value="__('RFC')" />
        <x-text-input id="rfc" class="block mt-1 w-full"
            type="text"
            name="rfc"
            required />
    </div>

    <!-- Género -->
    <div>
        <x-input-label for="genero" :value="__('Género')" />

        <select name="genero"
                id="genero"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">

            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>

        </select>
    </div>

    <!-- Gmail -->
    <div>
        <x-input-label for="gmail" :value="__('Correo Electrónico')" />
        <x-text-input id="gmail" class="block mt-1 w-full"
            type="email"
            name="gmail"
            required />
    </div>

    <!-- Grado académico -->
    <div>
        <x-input-label for="grado_academico" :value="__('Grado Académico')" />
        <x-text-input id="grado_academico" class="block mt-1 w-full"
            type="text"
            name="grado_academico"
            required />
    </div>
    <!-- Nombre de usuario -->
<div>
    <x-input-label for="username" :value="__('Nombre de Usuario')" />
    <x-text-input id="username" class="block mt-1 w-full"
    type="text"
    name="username"
    autocomplete="off"
    required />
</div>

<!-- Contraseña -->
<div>
    <x-input-label for="password" :value="__('Contraseña')" />
    <x-text-input id="password" class="block mt-1 w-full"
    type="password"
    name="password"
    required />
</div>

</div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                            {{ __('Cancelar') }}
                        </a>
                        <x-primary-button>
                            {{ __('Registrar Docente') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
