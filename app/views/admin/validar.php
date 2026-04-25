<h1>Validación de Vecinos</h1>
<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Piso</th>
                <th>Puerta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pendientes as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['nombre']) ?></td>
                
                <td><?= htmlspecialchars($p['piso']) ?></td>
                
                <td><?= htmlspecialchars($p['puerta']) ?></td>
                
                <td>
                    <div class="btn-group">
                        <a href="admin.php?action=aprobar&id=<?= $p['id'] ?>" class="btn-admin btn-approve">Aprobar</a>
                        <a href="admin.php?action=rechazar&id=<?= $p['id'] ?>" class="btn-admin btn-reject">Rechazar</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if(empty($pendientes)): ?>
                <tr><td colspan="4" class="empty-state">No hay solicitudes hoy.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>