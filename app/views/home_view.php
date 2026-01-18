<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Comunidad</title>
    <link rel="stylesheet" href="public/css/home.css">
</head>
<body>

<header class="header-minimal">
    <h1>Portal Comunidad</h1>
    <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
</header>

<div class="main-container">
    <nav class="tab-menu">
        <button class="tab-link active" onclick="openTab(event, 'tablon')">Tablón de Anuncios</button>
        <button class="tab-link" onclick="openTab(event, 'objetos')">Objetos Compartidos</button>
        <button class="tab-link" onclick="openTab(event, 'chat')">Chat Grupal</button>
    </nav>

    <div id="tablon" class="tab-content active">
        <h2>Avisos Oficiales</h2>
        <?php if (empty($anuncios)): ?>
            <p>No hay avisos por el momento.</p>
        <?php else: ?>
            <?php foreach($anuncios as $a): ?>
                <div class="announcement-card">
                    <span class="meta">Publicado el: <?php echo date('d/m/Y', strtotime($a['fecha_publicacion'])); ?></span>
                    <h3><?php echo htmlspecialchars($a['titulo']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($a['contenido'])); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div id="objetos" class="tab-content">
        <h2>Economía Circular</h2>
        <div class="objects-grid">
            <div class="object-item">
                <p>Herramienta de ejemplo</p>
                <button>Próximamente</button>
            </div>
        </div>
    </div>

    <div id="chat" class="tab-content">
        <h2>Mensajes de la comunidad</h2>
        <div style="height: 200px; border: 1px solid #eee; margin-bottom: 10px;"></div>
        <input type="text" placeholder="Escribe un mensaje..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
    </div>
</div>

<script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
        tabcontent[i].classList.remove("active");
    }
    tablinks = document.getElementsByClassName("tab-link");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.classList.add("active");
}
</script>
</body>
</html>