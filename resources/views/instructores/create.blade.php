<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Nuevo Instructor
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

                <form action="{{ route('instructores.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf

                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Datos Personales</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <x-input-label for="nombre" :value="__('Nombre(s)')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text"
                                name="nombre" value="{{ old('nombre') }}" required />
                        </div>

                        <div>
                            <x-input-label for="apellido_paterno" :value="__('Apellido Paterno')" />
                            <x-text-input id="apellido_paterno" class="block mt-1 w-full" type="text"
                                name="apellido_paterno" value="{{ old('apellido_paterno') }}" required />
                        </div>

                        <div>
                            <x-input-label for="apellido_materno" :value="__('Apellido Materno')" />
                            <x-text-input id="apellido_materno" class="block mt-1 w-full" type="text"
                                name="apellido_materno" value="{{ old('apellido_materno') }}" required />
                        </div>

                        <div>
                            <x-input-label for="curp" :value="__('CURP')" />
                            <x-text-input id="curp" class="block mt-1 w-full" type="text"
                                name="curp" value="{{ old('curp') }}" maxlength="18" required
                                oninput="this.value = this.value.toUpperCase()" />
                        </div>

                        <div>
                            <x-input-label for="rfc" :value="__('RFC')" />
                            <x-text-input id="rfc" class="block mt-1 w-full" type="text"
                                name="rfc" value="{{ old('rfc') }}" maxlength="13" required
                                oninput="this.value = this.value.toUpperCase()" />
                        </div>

                        <div>
                            <x-input-label for="genero" :value="__('Género')" />
                            <select id="genero" name="genero" required
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Selecciona --</option>
                                <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino"  {{ old('genero') == 'Femenino'  ? 'selected' : '' }}>Femenino</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="gmail" :value="__('Correo Electrónico')" />
                            <x-text-input id="gmail" class="block mt-1 w-full" type="email"
                                name="gmail" value="{{ old('gmail') }}" required />
                        </div>

                        <div>
                            <x-input-label for="grado_academico" :value="__('Grado Académico')" />
                            <x-text-input id="grado_academico" class="block mt-1 w-full" type="text"
                                name="grado_academico" value="{{ old('grado_academico') }}" required />
                        </div>

                        <div>
                            <x-input-label for="especialidad" :value="__('Especialidad')" />
                            <x-text-input id="especialidad" class="block mt-1 w-full" type="text"
                                name="especialidad" value="{{ old('especialidad') }}" />
                        </div>

                    </div>

                    <h3 class="text-lg font-semibold text-gray-700 mt-8 mb-4">Credenciales de Acceso</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <x-input-label for="username_display" :value="__('Nombre de Usuario (generado automáticamente)')" />
                            <x-text-input id="username_display" class="block mt-1 w-full bg-gray-100"
                                type="text" readonly placeholder="Se genera al escribir nombre y apellido" />
                            <input type="hidden" name="username" id="username" value="{{ old('username') }}" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Contraseña')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password"
                                name="password" required />
                        </div>

                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline">← Regresar</a>
                        <x-primary-button>Registrar Instructor</x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function generarUsername() {
            const nombre = document.getElementById('nombre').value.trim().split(' ')[0].toLowerCase();
            const apPat  = document.getElementById('apellido_paterno').value.trim().toLowerCase();
            const user   = (nombre + '.' + apPat)
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/\s+/g, '');
            document.getElementById('username').value         = user;
            document.getElementById('username_display').value = user;
        }

        document.getElementById('nombre').addEventListener('input', generarUsername);
        document.getElementById('apellido_paterno').addEventListener('input', generarUsername);
    </script>
</x-app-layout>