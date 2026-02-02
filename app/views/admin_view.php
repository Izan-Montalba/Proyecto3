<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="public/css/home.css">
    <link rel="stylesheet" href="public/css/admin.css">
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
    <?php if ($seccion === 'inicio'): ?>
        <h1>Bienvenido, Administrador</h1>
        <p>Selecciona una opción en el menú para gestionar la comunidad.</p>

    <?php elseif ($seccion === 'validar'): ?>
        <h1>Validación de Vecinos</h1>
        <div class="admin-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Vivienda</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pendientes as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nombre']) ?></td>
                        <td>Piso <?= htmlspecialchars($p['piso']) ?> - <?= htmlspecialchars($p['puerta']) ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="admin.php?action=aprobar&id=<?= $p['id'] ?>" class="btn-admin btn-approve">Aprobar</a>
                                <a href="admin.php?action=rechazar&id=<?= $p['id'] ?>" class="btn-admin btn-reject">Rechazar</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($pendientes)): ?>
                        <tr><td colspan="3" class="empty-state">No hay solicitudes hoy.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

</body>
</html>