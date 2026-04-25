<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Acceso - Comunidad</title>
    <link rel="stylesheet" href="public/css/home.css">
    <link rel="stylesheet" href="public/css/registro.css">
</head>
<body class="registro-screen">

    <div class="registro-container card">
        <div class="registro-header">
            <h2>Solicitud de Acceso</h2>
            <p>Introduce tus datos para registrarte</p>
        </div>

        <form action="index.php?action=procesar_registro" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" name="nombre" id="nombre" class="registro-input" placeholder="Ej. Juan Pérez" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="registro-input" placeholder="tu@email.com" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="registro-input" placeholder="Mínimo 6 caracteres" required>
            </div>
            
            <div class="form-row">
                <div class="form-group flex-1">
                    <label for="piso">Piso</label>
                    <input type="text" name="piso" id="piso" class="registro-input" placeholder="Ej. 3º" required>
                </div>
                <div class="form-group flex-1">
                    <label for="puerta">Puerta</label>
                    <input type="text" name="puerta" id="puerta" class="registro-input" placeholder="Ej. 7" required>
                </div>
            </div>

            <button type="submit" class="btn-registro">
                Enviar Solicitud
            </button>

            <div class="footer-link">
                ¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a>
            </div>
        </form>
    </div>

</body>
</html>