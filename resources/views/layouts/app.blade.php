<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Legión — Sistema Académico</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border-radius: 8px;
            color: #94a3b8;
            font-size: 13.5px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s;
            width: 100%;
            text-align: left;
            background: transparent;
            border: none;
            cursor: pointer;
        }
        .sidebar-link:hover {
            background: #334155;
            color: #fff;
        }
        .sidebar-link.active {
            background: #2563eb;
            color: #fff;
            box-shadow: 0 2px 8px rgba(37,99,235,0.3);
        }
        .sidebar-section {
            font-size: 10px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0 14px;
            margin-top: 20px;
            margin-bottom: 6px;
            display: block;
        }
        .sidebar-icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }
    </style>
</head>
<body class="font-sans antialiased bg-slate-100" x-data="{ sidebarOpen: true }">

<div style="display:flex; height:100vh; overflow:hidden;">

    {{-- ── SIDEBAR ──────────────────────────────────────────────── --}}
    <aside x-show="sidebarOpen"
           x-transition:enter="transition-all duration-300"
           x-transition:enter-start="opacity-0 -translate-x-full"
           x-transition:enter-end="opacity-100 translate-x-0"
           style="width:256px; background:#0f172a; display:flex; flex-direction:column; flex-shrink:0; overflow:hidden;">

        {{-- Logo --}}
        <div style="display:flex; align-items:center; gap:12px; padding:20px 16px; border-bottom:1px solid #1e293b;">
            <div style="width:36px;height:36px;background:#2563eb;border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-weight:800;font-size:18px;flex-shrink:0;">
                L
            </div>
            <div style="line-height:1.2;">
                <div style="color:white;font-weight:800;font-size:17px;letter-spacing:1px;font-style:italic;">LEGIÓN</div>
                <div style="color:#64748b;font-size:10px;letter-spacing:2px;text-transform:uppercase;">Sistema Académico</div>
            </div>
        </div>

        {{-- Navegación --}}
        <nav style="flex:1; padding:12px; overflow-y:auto;">

            {{-- ── JEFATURA ── --}}
            @if(Auth::user()->role === 'jefatura')
                <span class="sidebar-section">Principal</span>
                <a href="{{ route('jefatura.dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('jefatura.dashboard') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Inicio
                </a>

                <span class="sidebar-section">Gestión</span>
                <a href="{{ route('cursos.create') }}"
                   class="sidebar-link {{ request()->routeIs('cursos.*') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Registrar Curso
                </a>
                <a href="{{ route('docentes.create') }}"
                   class="sidebar-link {{ request()->routeIs('docentes.*') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Registrar Personal
                </a>
                <a href="{{ route('instructores.create') }}"
                   class="sidebar-link {{ request()->routeIs('instructores.*') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Registrar Instructor
                </a>
                <a href="{{ route('asignaciones.create') }}"
                   class="sidebar-link {{ request()->routeIs('asignaciones.*') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Inscribir al Curso
                </a>
                <a href="{{ route('reportes.asistencia') }}"
                   class="sidebar-link {{ request()->routeIs('reportes.*') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Reporte de Personal
                </a>
            @endif

            {{-- ── DOCENTE ── --}}
            @if(Auth::user()->role === 'docente')
                <span class="sidebar-section">Principal</span>
                <a href="{{ route('docente.dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('docente.dashboard') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Inicio
                </a>
                <span class="sidebar-section">Académico</span>
                <a href="{{ route('docente.calificaciones') }}"
                   class="sidebar-link {{ request()->routeIs('docente.calificaciones') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Mis Calificaciones
                </a>
                <a href="{{ route('docente.ficha-tecnica') }}"
                   class="sidebar-link {{ request()->routeIs('docente.ficha-tecnica') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    Ficha Técnica
                </a>
            @endif

            {{-- ── INSTRUCTOR ── --}}
            @if(Auth::user()->role === 'instructor')
                <span class="sidebar-section">Principal</span>
                <a href="{{ route('instructor.dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('instructor.dashboard') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Inicio
                </a>
                <span class="sidebar-section">Cursos</span>
                <a href="{{ route('instructor.dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('instructor.calificaciones*') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Registrar Calificaciones
                </a>
            @endif

            {{-- ── CUENTA ── --}}
            <span class="sidebar-section">Cuenta</span>
            <a href="{{ route('profile.edit') }}"
               class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Mi Perfil
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link">
                    <svg class="sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Cerrar Sesión
                </button>
            </form>

        </nav>
    </aside>

    {{-- ── CONTENIDO PRINCIPAL ─────────────────────────────────── --}}
    <div style="flex:1; display:flex; flex-direction:column; overflow:hidden;">

        {{-- Topbar --}}
        <header style="background:white; border-bottom:1px solid #e2e8f0; display:flex; align-items:center; justify-content:space-between; padding:0 24px; height:56px; flex-shrink:0;">

            <button @click="sidebarOpen = !sidebarOpen"
                    style="padding:8px; border-radius:8px; color:#64748b; background:transparent; border:none; cursor:pointer;"
                    onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                <svg style="width:22px;height:22px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            @isset($header)
                <div style="font-size:15px; font-weight:600; color:#334155;">{{ $header }}</div>
            @endisset

            <div style="display:flex; align-items:center; gap:10px;">
                <div style="text-align:right;">
                    <div style="font-size:13px; font-weight:600; color:#334155;">{{ Auth::user()->name }}</div>
                    <div style="font-size:11px; color:#94a3b8; text-transform:capitalize;">{{ Auth::user()->role }}</div>
                </div>
                <div style="width:36px;height:36px;border-radius:50%;background:#2563eb;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:14px;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>

        </header>

        {{-- Página --}}
        <main style="flex:1; overflow-y:auto; padding:24px; background:#f1f5f9;">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer style="background:white; border-top:1px solid #e2e8f0; padding:10px 24px; display:flex; justify-content:space-between; font-size:11px; color:#94a3b8; flex-shrink:0;">
            <span>© {{ date('Y') }} LEGIÓN. Todos los derechos reservados.</span>
            <span>Sistema de Gestión Académica</span>
        </footer>

    </div>

</div>

</body>
</html>