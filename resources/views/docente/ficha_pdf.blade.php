<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha Técnica — {{ $docente->nombre_completo }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #1a1a1a; padding: 30px; }
        .header { text-align: center; border-bottom: 2px solid #4338ca; padding-bottom: 16px; margin-bottom: 20px; }
        .header h1 { font-size: 20px; color: #4338ca; }
        .header p { font-size: 11px; color: #666; margin-top: 4px; }
        .seccion { margin-bottom: 20px; }
        .seccion h2 { font-size: 13px; background: #4338ca; color: white; padding: 6px 10px; margin-bottom: 8px; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 6px 20px; padding: 0 10px; }
        .campo label { font-weight: bold; color: #555; font-size: 10px; }
        .campo p { font-size: 12px; border-bottom: 1px solid #ddd; padding-bottom: 2px; margin-top: 1px; }
        table { width: 100%; border-collapse: collapse; font-size: 11px; }
        table thead tr { background: #4338ca; color: white; }
        table th, table td { border: 1px solid #ccc; padding: 5px 8px; }
        table tbody tr:nth-child(even) { background: #f5f5ff; }
        .footer { margin-top: 40px; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
        .firma { text-align: center; }
        .firma .linea { border-top: 1px solid #333; margin-bottom: 4px; }
        .no-print { margin-bottom: 20px; }
        @media print { .no-print { display: none !important; } }
    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="window.print()"
            style="background:#4338ca;color:white;padding:8px 20px;border:none;border-radius:4px;cursor:pointer;font-size:13px;">
            🖨 Imprimir / Guardar PDF
        </button>
        <a href="{{ route('docente.dashboard') }}"
            style="margin-left:12px;color:#4338ca;font-size:13px;">← Regresar</a>
    </div>

    {{-- Encabezado --}}
    <div class="header">
        <h1>FICHA TÉCNICA DEL DOCENTE</h1>
        <p>Sistema de Gestión de Cursos · Generada el {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    {{-- Datos personales --}}
    <div class="seccion">
        <h2>DATOS PERSONALES</h2>
        <div class="grid">
            <div class="campo">
                <label>Nombre Completo</label>
                <p>{{ $docente->nombre_completo }}</p>
            </div>
            <div class="campo">
                <label>CURP</label>
                <p>{{ $docente->curp }}</p>
            </div>
            <div class="campo">
                <label>RFC</label>
                <p>{{ $docente->rfc }}</p>
            </div>
            <div class="campo">
                <label>Género</label>
                <p>{{ $docente->genero }}</p>
            </div>
            <div class="campo">
                <label>Correo Electrónico</label>
                <p>{{ $docente->gmail }}</p>
            </div>
        </div>
    </div>

    {{-- Datos académicos --}}
    <div class="seccion">
        <h2>DATOS ACADÉMICOS</h2>
        <div class="grid">
            <div class="campo">
                <label>Grado Académico</label>
                <p>{{ $docente->grado_academico ?? '—' }}</p>
            </div>
            <div class="campo">
                <label>Carrera</label>
                <p>{{ $docente->carrera ?? '—' }}</p>
            </div>
            <div class="campo">
                <label>Especialidad</label>
                <p>{{ $docente->especialidad ?? '—' }}</p>
            </div>
            <div class="campo">
                <label>Departamento</label>
                <p>{{ $docente->departamento ?? '—' }}</p>
            </div>
            <div class="campo">
                <label>Rol</label>
                <p>{{ $docente->rol ?? '—' }}</p>
            </div>
        </div>
    </div>

    {{-- Cursos inscritos --}}
    <div class="seccion">
        <h2>CURSOS INSCRITOS</h2>
        @forelse($cursos as $curso)
            <table style="margin-bottom:12px;">
                <thead>
                    <tr>
                        <th colspan="4" style="text-align:left;">
                            {{ $curso->nombre }} — Clave: {{ $curso->clave }}
                            ({{ $curso->fecha_inicio }} al {{ $curso->fecha_fin }})
                        </th>
                    </tr>
                    <tr>
                        <th>Unidad</th>
                        <th>Nombre</th>
                        <th>Calificación</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($curso->unidades as $unidad)
                        @php
                            $cal = $calificaciones[$curso->id][$unidad->id]->calificacion ?? null;
                        @endphp
                        <tr>
                            <td style="text-align:center;">{{ $unidad->numero_unidad }}</td>
                            <td>{{ $unidad->nombre }}</td>
                            <td style="text-align:center;font-weight:bold;">{{ $cal ?? '—' }}</td>
                            <td style="text-align:center;">
                                @if($cal === null) Pendiente
                                @elseif($cal >= 60) Aprobado
                                @else Reprobado
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @empty
            <p style="padding:8px;color:#666;">Sin cursos inscritos.</p>
        @endforelse
    </div>

    {{-- Firmas --}}
    <div class="footer">
        <div class="firma">
            <br><br>
            <div class="linea"></div>
            <p>{{ $docente->nombre_completo }}</p>
            <p style="font-size:10px;color:#666;">Docente</p>
        </div>
        <div class="firma">
            <br><br>
            <div class="linea"></div>
            <p>Jefatura</p>
            <p style="font-size:10px;color:#666;">Vo. Bo.</p>
        </div>
    </div>

</body>
</html>