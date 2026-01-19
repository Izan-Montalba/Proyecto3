<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Comunidad</title>
    <link rel="stylesheet" href="public/css/home.css">
</head>
<body>

<nav class="sidebar">
    <h2>COMUNIDAD</h2>
    <button class="tab-link active" onclick="openTab(event, 'tablon')">📢 Tablón</button>
    <button class="tab-link" onclick="openTab(event, 'calendario')">📅 Calendario</button>
    <button class="tab-link" onclick="openTab(event, 'objetos')">🛠️ Objetos</button>
    <button class="tab-link" onclick="openTab(event, 'chat')">💬 Chat</button>
    
    <a href="logout.php" class="logout-link">Cerrar Sesión</a>
</nav>

<main class="main-content">
    
    <div id="tablon" class="tab-content active">
        <h1>Tablón de Anuncios</h1>
        <?php foreach($anuncios as $a): ?>
            <div class="card">
                <small><?= date('d/m/Y', strtotime($a['fecha_publicacion'])) ?></small>
                <h3><?= htmlspecialchars($a['titulo']) ?></h3>
                <p><?= nl2br(htmlspecialchars($a['contenido'])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div id="calendario" class="tab-content">
        <h1>Calendario de la Finca</h1>
        <div class="card"><p>Próximas reuniones y eventos...</p></div>
    </div>

    <div id="objetos" class="tab-content">
        <h1>Objetos Compartidos</h1>
        <div class="card"><p>Herramientas disponibles para préstamo...</p></div>
    </div>

    <div id="chat" class="tab-content">
        <h1>Chat Grupal</h1>
        <div class="card chat-container">
            <div class="chat-messages" id="chat-box">
                <div class="message">
                    <strong>Portería:</strong> Bienvenidos al chat de la comunidad.
                </div>
                </div>
            <div class="chat-input-area">
                <input type="text" placeholder="Escribe un mensaje..." id="msg-input">
                <button>Enviar</button>
            </div>
        </div>
    </div>

</main>

<script>
function openTab(evt, tabName) {
    let i, content, links;
    content = document.getElementsByClassName("tab-content");
    for (i = 0; i < content.length; i++) {
        content[i].style.display = "none";
    }
    links = document.getElementsByClassName("tab-link");
    for (i = 0; i < links.length; i++) {
        links[i].classList.remove("active");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.classList.add("active");
}
</script>
</body>
</html>