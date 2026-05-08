<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Nuevo Docente') }}
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

                <form action="{{ route('docentes.store') }}" method="POST">
                    @csrf

                    <h3 class="text-lg font-semibold text-gray-700 mb-4">
                        Datos Personales
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Nombre -->
                        <div>
                            <x-input-label for="nombre" :value="__('Nombre(s)')" />
                            <x-text-input id="nombre" class="block mt-1 w-full"
                                type="text"
                                name="nombre"
                                value="{{ old('nombre') }}"
                                required />
                        </div>

                        <!-- Apellido paterno -->
                        <div>
                            <x-input-label for="apellido_paterno" :value="__('Apellido Paterno')" />
                            <x-text-input id="apellido_paterno" class="block mt-1 w-full"
                                type="text"
                                name="apellido_paterno"
                                value="{{ old('apellido_paterno') }}"
                                required />
                        </div>

                        <!-- Apellido materno -->
                        <div>
                            <x-input-label for="apellido_materno" :value="__('Apellido Materno')" />
                            <x-text-input id="apellido_materno" class="block mt-1 w-full"
                                type="text"
                                name="apellido_materno"
                                value="{{ old('apellido_materno') }}"
                                required />
                        </div>

                        <!-- CURP -->
                        <div>
                            <x-input-label for="curp" :value="__('CURP')" />
                            <x-text-input id="curp" class="block mt-1 w-full"
                                type="text"
                                name="curp"
                                value="{{ old('curp') }}"
                                maxlength="18"
                                required />
                        </div>

                        <!-- RFC -->
                        <div>
                            <x-input-label for="rfc" :value="__('RFC')" />
                            <x-text-input id="rfc" class="block mt-1 w-full"
                                type="text"
                                name="rfc"
                                value="{{ old('rfc') }}"
                                maxlength="13"
                                required />
                        </div>

                        <!-- Género -->
                        <div>
                            <x-input-label for="genero" :value="__('Género')" />

                            <select id="genero"
                                    name="genero"
                                    required
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">

                                <option value="">-- Selecciona --</option>

                                <option value="Masculino"
                                    {{ old('genero') == 'Masculino' ? 'selected' : '' }}>
                                    Masculino
                                </option>

                                <option value="Femenino"
                                    {{ old('genero') == 'Femenino' ? 'selected' : '' }}>
                                    Femenino
                                </option>

                            </select>
                        </div>

                        <!-- Gmail -->
                        <div>
                            <x-input-label for="gmail" :value="__('Correo Electrónico')" />

                            <x-text-input id="gmail"
                                class="block mt-1 w-full"
                                type="email"
                                name="gmail"
                                value="{{ old('gmail') }}"
                                required />
                        </div>

                        <!-- Grado académico -->
                        <div>
                            <x-input-label for="grado_academico" :value="__('Grado Académico')" />

                            <x-text-input id="grado_academico"
                                class="block mt-1 w-full"
                                type="text"
                                name="grado_academico"
                                value="{{ old('grado_academico') }}"
                                required />
                        </div>

                    </div>

                    <!-- Credenciales -->
                    <h3 class="text-lg font-semibold text-gray-700 mt-8 mb-4">
                        Credenciales de Acceso
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Username -->
                        <div>
                            <x-input-label for="username" :value="__('Nombre de Usuario')" />

                            <x-text-input id="username"
                                class="block mt-1 w-full"
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                required />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Contraseña')" />

                            <x-text-input id="password"
                                class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required />
                        </div>

                    </div>

                    <div class="flex items-center justify-between mt-6">

                        <a href="{{ route('dashboard') }}"
                           class="text-gray-600 hover:underline">

                            ← Regresar

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