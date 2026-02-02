<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comunidad</title>
    <link rel="stylesheet" href="public/css/home.css">
    <link rel="stylesheet" href="public/css/objetos.css">
    <link rel="stylesheet" href="public/css/anuncios.css">
    <link rel="stylesheet" href="public/css/chat.css">
</head>
<body class="pagina-<?= $seccion ?>">

<nav class="sidebar">
    <h2>MI COMUNIDAD</h2>
    
    <div class="menu-links">
        <button class="btn-tablon" onclick="window.location.href='home.php?seccion=tablon'">📢 Tablón</button>
        <button class="btn-calendario" onclick="window.location.href='home.php?seccion=calendario'">📅 Calendario</button>
        <button class="btn-objetos" onclick="window.location.href='home.php?seccion=objetos'">🛠️ Objetos</button>
        <button class="btn-chat" onclick="window.location.href='home.php?seccion=chat'">💬 Chat</button>
        <button class="btn-sugerencias" onclick="window.location.href='home.php?seccion=sugerencias'">💬 Sugerencias</button>
    </div>

    <div class="logout-container">
        <a href="logout.php" class="logout-link">Cerrar Sesión</a>
    </div>
</nav>

<div class="content">
    <?php include $seccion . ".php"; ?>
</div>

</body>
</html>