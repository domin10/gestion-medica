<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Pacientes</title>
</head>
<body>
    <h1>Lista de pacientes</h1>
    
    @foreach($pacientes as $paciente)
        <p>{{ $paciente->nombre }} — {{ $paciente->edad }} años — {{ $paciente->telefono }}</p>
    @endforeach
</body>
</html>