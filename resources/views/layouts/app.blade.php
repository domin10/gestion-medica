<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Médica</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
            <span class="text-blue-600 font-semibold text-lg">Gestión Médica</span>
            <a href="/pacientes" class="text-gray-600 hover:text-blue-600 text-sm transition">Pacientes</a>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-10">
        @yield('content')
    </main>

</body>
</html>