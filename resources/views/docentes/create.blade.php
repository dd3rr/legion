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

                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Datos Personales</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <x-input-label for="nombre" :value="__('Nombre(s)')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text"
                                name="nombre" value="{{ old('nombre') }}" required />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="apellido_paterno" :value="__('Apellido Paterno')" />
                            <x-text-input id="apellido_paterno" class="block mt-1 w-full" type="text"
                                name="apellido_paterno" value="{{ old('apellido_paterno') }}" required />
                            <x-input-error :messages="$errors->get('apellido_paterno')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="apellido_materno" :value="__('Apellido Materno')" />
                            <x-text-input id="apellido_materno" class="block mt-1 w-full" type="text"
                                name="apellido_materno" value="{{ old('apellido_materno') }}" required />
                            <x-input-error :messages="$errors->get('apellido_materno')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="curp" :value="__('CURP')" />
                            <x-text-input id="curp" class="block mt-1 w-full" type="text"
                                name="curp" value="{{ old('curp') }}" maxlength="18" required />
                            <x-input-error :messages="$errors->get('curp')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="rfc" :value="__('RFC')" />
                            <x-text-input id="rfc" class="block mt-1 w-full" type="text"
                                name="rfc" value="{{ old('rfc') }}" maxlength="13" required />
                            <x-input-error :messages="$errors->get('rfc')" class="mt-2" />
                        </div>

                        {{-- Género --}}
                        <div>
                            <x-input-label for="genero" :value="__('Género')" />
                            <select id="genero" name="genero" required
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                                <option value="">-- Selecciona --</option>
                                <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino"  {{ old('genero') == 'Femenino'  ? 'selected' : '' }}>Femenino</option>
                                <option value="Otro"      {{ old('genero') == 'Otro'      ? 'selected' : '' }}>Otro</option>
                            </select>
                            <x-input-error :messages="$errors->get('genero')" class="mt-2" />
                        </div>

                        {{-- Departamento --}}
                        <div>
                            <x-input-label for="departamento" :value="__('Departamento')" />
                            <select id="departamento" name="departamento" required
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                                <option value="">-- Selecciona --</option>
                                <option value="Ciencias Básicas"      {{ old('departamento') == 'Ciencias Básicas'      ? 'selected' : '' }}>Ciencias Básicas</option>
                                <option value="Industrial"            {{ old('departamento') == 'Industrial'            ? 'selected' : '' }}>Industrial</option>
                                <option value="Química"               {{ old('departamento') == 'Química'               ? 'selected' : '' }}>Química</option>
                                <option value="Sistemas"              {{ old('departamento') == 'Sistemas'              ? 'selected' : '' }}>Sistemas</option>
                                <option value="Mecánica"              {{ old('departamento') == 'Mecánica'              ? 'selected' : '' }}>Mecánica</option>
                                <option value="Civil"                 {{ old('departamento') == 'Civil'                 ? 'selected' : '' }}>Civil</option>
                                <option value="Gestión Empresarial"   {{ old('departamento') == 'Gestión Empresarial'   ? 'selected' : '' }}>Gestión Empresarial</option>
                            </select>
                            <x-input-error :messages="$errors->get('departamento')" class="mt-2" />
                        </div>

                    </div>

                    {{-- Credenciales --}}
                    <h3 class="text-lg font-semibold text-gray-700 mt-8 mb-4">Credenciales de Acceso</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <x-input-label for="name" :value="__('Nombre de Usuario')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text"
                                name="name" value="{{ old('name') }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Correo Electrónico')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email"
                                name="email" value="{{ old('email') }}" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="password" :value="__('Contraseña (mínimo 8 caracteres)')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password"
                                name="password" required />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline">
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