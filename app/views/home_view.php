<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de la Comunidad</title>
    <link rel="stylesheet" href="public/css/home.css">
</head>
<body>
    <header class="main-header">
        <h1>Portal de la Comunidad</h1>
        <div class="user-info">
            <span>Bienvenido, Vecino</span>
            <a href="logout.php" class="btn-exit">Cerrar Sesión</a>
        </div>
    </header>

    <div class="dashboard-container">
        <section class="board">
            <h2>Tablón de Anuncios</h2>
            <div class="announcement">
                <span class="date">17/01/2026</span>
                <p><strong>Aviso:</strong> Corte de agua el próximo martes por obras en la caldera.</p>
            </div>
        </section>

        <section class="tools">
            <h2>Objetos Compartidos</h2>
            <p>Fomentando la economía circular. No compres, ¡comparte!</p>
            <div class="item-grid">
                <div class="item-card">
                    <p>Taladro Percutor</p>
                    <button>Reservar</button>
                </div>
                <div class="item-card">
                    <p>Escalera 3m</p>
                    <button>Reservar</button>
                </div>
            </div>
        </section>

        <div class="row">
            <section class="chat-preview">
                <h2>Chat Comunitario</h2>
                <div class="chat-box">
                    <p><strong>Piso 3A:</strong> ¿Alguien tiene sal?</p>
                </div>
                <input type="text" placeholder="Escribe un mensaje...">
            </section>

            <section class="calendar-preview">
                <h2>Próximos Eventos</h2>
                <ul>
                    <li>Reunión de vecinos - 20 Feb</li>
                    <li>Limpieza de garaje - 25 Feb</li>
                </ul>
            </section>
        </div>
    </div>
</body>
</html>