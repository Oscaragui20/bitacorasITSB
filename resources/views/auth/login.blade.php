<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body class="fondo-circulos">

    <div class="slogan"></div>

    <div class="login-container">
        <h2>Iniciar Sesión</h2>

        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="error-message" style="color: green;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mensaje de error --}}
        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="contraseña">Contraseña:</label>
            <input type="password" name="contraseña" id="contraseña" required>
<br><br>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>

</body>
</html>
