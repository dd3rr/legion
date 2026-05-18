<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta — {{ $curso->nombre }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #1a1a1a; padding: 30px; }
        .header { text-align: center; border-bottom: 2px solid #4338ca; padding-bottom: 16px; margin-bottom: 20px; }
        .header h1 { font-size: 20px; color: #4338ca; }
        .header p { font-size: 11px; color: #666; margin-top: 4px; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 6px 20px; margin-bottom: 20px; padding: 10px; background: #f5f5ff; border-radius: 4px; }
        .campo label { font-weight: bold; color: #555; font-size: 10px; }
        .campo p { font-size: 12px; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        table thead tr { background: #4338ca; color: white; }
        table th, table td { border: 1px solid #ccc; padding: 7px 10px; }
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
        <a href="{{ route('docente.calificaciones') }}"
            style="margin-left:12px;color:#4338ca;font-size:13px;">← Regresar</a>
    </div>

    <div class="header">
        <h1>BOLETA DE CALIFICACIONES</h1>
        <p>Sistema de Gestión de Cursos · Generada el {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="info-grid">
        <div class="campo">
            <label>Docente</label>
            <p>{{ $docente->nombre_completo }}</p>
        </div>
        <div class="campo">
            <label>Curso</label>
            <p>{{ $curso->nombre }}</p>
        </div>
        <div class="campo">
            <label>Clave</label>
            <p>{{ $curso->clave }}</p>
        </div>
        <div class="campo">
            <label>Periodo</label>
            <p>{{ $curso->fecha_inicio }} al {{ $curso->fecha_fin }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No. Unidad</th>
                <th>Nombre de la Unidad</th>
                <th>Calificación</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($curso->unidades as $unidad)
                @php $cal = $calificaciones[$unidad->id]->calificacion ?? null; @endphp
                <tr>
                    <td style="text-align:center;">{{ $unidad->numero_unidad }}</td>
                    <td>{{ $unidad->nombre }}</td>
                    <td style="text-align:center;font-weight:bold;
                        color:{{ $cal === null ? '#999' : ($cal >= 60 ? '#16a34a' : '#dc2626') }}">
                        {{ $cal ?? '—' }}
                    </td>
                    <td style="text-align:center;">
                        @if($cal === null) <span style="color:#999;">Pendiente</span>
                        @elseif($cal >= 60) <span style="color:#16a34a;">Aprobado</span>
                        @else <span style="color:#dc2626;">Reprobado</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            @php
                $vals = $calificaciones->map(fn($c) => $c->calificacion)->filter(fn($v) => $v !== null);
                $prom = $vals->count() > 0 ? round($vals->avg(), 1) : null;
            @endphp
            <tr style="background:#e0e7ff;font-weight:bold;">
                <td colspan="2" style="text-align:right;padding-right:10px;">Promedio General</td>
                <td style="text-align:center;font-size:14px;
                    color:{{ $prom !== null && $prom >= 60 ? '#16a34a' : '#dc2626' }}">
                    {{ $prom ?? '—' }}
                </td>
                <td style="text-align:center;">
                    @if($prom !== null)
                        @if($prom >= 60) <span style="color:#16a34a;">Aprobado</span>
                        @else <span style="color:#dc2626;">Reprobado</span>
                        @endif
                    @endif
                </td>
            </tr>
        </tfoot>
    </table>

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
            <p>Instructor</p>
            <p style="font-size:10px;color:#666;">Vo. Bo.</p>
        </div>
    </div>

</body>
</html>