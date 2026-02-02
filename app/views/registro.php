<form action="index.php?action=procesar_registro" method="POST">
    <h2>Solicitud de Acceso</h2>
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    
    <div style="display: flex; gap: 10px;">
        <input type="text" name="piso" placeholder="Piso (ej: 3º)" required>
        <input type="text" name="puerta" placeholder="Puerta (ej: B)" required>
    </div>

    <button type="submit">Enviar Solicitud</button>
    <p>¿Ya tienes cuenta? <a href="index.php">Inicia sesión</a></p>
</form>