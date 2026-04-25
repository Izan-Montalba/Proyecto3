<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="public/css/home.css">
    <link rel="stylesheet" href="public/css/admin/admin.css">
    <link rel="stylesheet" href="public/css/admin/anunciosAdmin.css">
    <link rel="stylesheet" href="public/css/admin/objetos.css">

</head>
<body class="admin-panel">

<nav class="sidebar">
    <h2>ADMINISTRACIÓN</h2>
    
    <div class="menu-links">
        <button onclick="window.location.href='admin.php?seccion=inicio'">📊 Dashboard</button>
        <button onclick="window.location.href='admin.php?seccion=validar'">👥 Validar Vecinos</button>
        <button onclick="window.location.href='admin.php?seccion=anuncios'">📢 Moderar Anuncios</button>
        <button onclick="window.location.href='admin.php?seccion=objetos'">🛠️ Inventario Común</button>
    </div>

    <div class="logout-container">
        <a href="logout.php" class="logout-link">Cerrar Sesión</a>
    </div>
</nav>

<div class="content">
    <?php include "admin/".$seccion . ".php"; ?>
</div>

</body>
</html>