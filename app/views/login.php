<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Inicio de sesión</title>
  <link rel="stylesheet" href="public/css/style.css" />
</head>
<body>
  <div class="login-container">
    <h1>Comunidad de Vecinos</h1>

    <form action="index.php?action=procesar_login" method="POST">
      <label for="email">Correo electrónico</label>
      <input type="email" name="email" id="email" required />

      <label for="password">Contraseña</label>
      <input type="password" name="password" id="password" required />

      <button type="submit">Iniciar sesión</button>
    </form>

    <?php if(isset($error)): ?>
        <p style="color: red; text-align: center; margin-top: 10px;"><?php echo $error; ?></p>
    <?php endif; ?>

    <p class="info">¿No tienes cuenta? Solicita acceso a la comunidad</p>
  </div>
</body>
</html>