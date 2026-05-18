<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat relative"
         style="background-image: url('https://i1-c.pinimg.com/1200x/31/0d/46/310d46c63db719604362e80d76ed9afd.jpg');">

        {{-- Capa oscura encima del fondo --}}
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        {{-- Contenedor Login --}}
        <div class="relative z-10 w-full max-w-md px-6">

            {{-- Logo --}}
            <div class="text-center mb-8">
                <div class="w-20 h-20 mx-auto bg-blue-600 rounded-3xl flex items-center justify-center shadow-lg">
                    <span class="text-white text-4xl font-bold">L</span>
                </div>

                <h1 class="text-5xl font-extrabold text-white tracking-widest mt-5">
                    LEGIÓN
                </h1>

                <p class="text-slate-300 mt-2 text-lg">
                    Plataforma de Gestión Académica
                </p>
            </div>

            {{-- Card --}}
            <div class="bg-white/10 backdrop-blur-xl border border-white/20 shadow-2xl rounded-3xl p-8">

                <h2 class="text-4xl font-bold text-white mb-2">
                    Iniciar Sesión
                </h2>

                <p class="text-slate-300 mb-8">
                    Ingresa tus credenciales para acceder al sistema.
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-200 mb-2">
                            Correo Electrónico
                        </label>

                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               autocomplete="username"
                               class="w-full rounded-2xl border border-white/20 bg-white/90 px-5 py-4 text-slate-800 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none">

                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                    </div>

                    <!-- Password -->
                    <div class="mt-6">
                        <label class="block text-sm font-semibold text-slate-200 mb-2">
                            Contraseña
                        </label>

                        <input id="password"
                               type="password"
                               name="password"
                               required
                               autocomplete="current-password"
                               class="w-full rounded-2xl border border-white/20 bg-white/90 px-5 py-4 text-slate-800 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none">

                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                    </div>

                    <!-- Remember -->
                    <div class="flex items-center justify-between mt-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me"
                                   type="checkbox"
                                   class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                   name="remember">

                            <span class="ms-2 text-sm text-slate-200">
                                Recordarme
                            </span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-300 hover:text-blue-200 transition"
                               href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <!-- Button -->
                    <button type="submit"
                            class="w-full mt-8 bg-blue-600 hover:bg-blue-700 transition text-white font-bold py-4 rounded-2xl shadow-lg text-lg">
                        Ingresar al Sistema
                    </button>
                </form>
            </div>

            {{-- Footer --}}
            <div class="text-center mt-6 text-slate-300 text-sm">
                © 2026 Legión · Sistema Académico
            </div>

        </div>
    </div>

</x-guest-layout>