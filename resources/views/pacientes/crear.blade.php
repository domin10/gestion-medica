<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Paciente</title>
</head>
<body>
    <h1>Nuevo paciente</h1>

    <form method="POST" action="/pacientes">
        @csrf
        <p>
            <label>Nombre:</label>
            <input type="text" name="nombre">
        </p>
        <p>
            <label>Edad:</label>
            <input type="number" name="edad">
        </p>
        <p>
            <label>Teléfono:</label>
            <input type="text" name="telefono">
        </p>
        <button type="submit">Guardar</button>
    </form>

    <a href="/pacientes">Volver a la lista</a>
</body>
</html>