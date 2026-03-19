<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; padding: 30px; }

        .header { margin-bottom: 30px; border-bottom: 3px solid #2563EB; padding-bottom: 15px; }
        .header h1 { font-size: 22px; color: #1e3a8a; margin-bottom: 4px; }
        .header p { color: #666; font-size: 11px; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        thead tr { background-color: #2563EB; color: white; }
        thead th { padding: 10px 12px; text-align: left; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; }
        tbody tr:nth-child(even) { background-color: #f0f4ff; }
        tbody tr:nth-child(odd) { background-color: #ffffff; }
        tbody td { padding: 9px 12px; border-bottom: 1px solid #e5e7eb; }

        .footer { margin-top: 30px; text-align: right; font-size: 10px; color: #999; }
        .badge { display: inline-block; background: #dbeafe; color: #1e40af; padding: 2px 8px; border-radius: 10px; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Gestión Médica — Listado de Pacientes</h1>
        <p>Generado el {{ now()->format('d/m/Y H:i') }} · Total: {{ $pacientes->count() }} pacientes</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Teléfono</th>
                <th>Registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
            <tr>
                <td>{{ $paciente->id }}</td>
                <td><strong>{{ $paciente->nombre }}</strong></td>
                <td><span class="badge">{{ $paciente->edad }} años</span></td>
                <td>{{ $paciente->telefono ?? '—' }}</td>
                <td>{{ $paciente->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Gestión Médica · Documento generado automáticamente
    </div>
</body>
</html>