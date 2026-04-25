<div class="admin-header">
    <h1>🛠️ Inventario de Objetos Comunes</h1>
</div>

<div class="form-objetos">
    <h3><?= isset($objetoEditar) ? "Editar Objeto" : "Añadir Nuevo Objeto" ?></h3>
    <form action="admin.php?action=guardar_objeto" method="POST">
        <?php if (isset($objetoEditar)): ?>
            <input type="hidden" name="id_objeto" value="<?= $objetoEditar['id'] ?>">
        <?php endif; ?>

        <div class="form-group">
            <label>Nombre del objeto</label>
            <input type="text" name="nombre" placeholder="Ej. Escalera, Taladro..." 
                   value="<?= $objetoEditar['nombre'] ?? '' ?>" required>
        </div>
        
        <div class="form-group">
            <label>Descripción / Estado</label>
            <textarea name="descripcion" placeholder="Detalles sobre el estado o ubicación..." required><?= $objetoEditar['descripcion'] ?? '' ?></textarea>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn-admin btn-approve">
                <?= isset($objetoEditar) ? "Guardar Cambios" : "Registrar Objeto" ?>
            </button>
            <?php if (isset($objetoEditar)): ?>
                <a href="admin.php?seccion=objetos" class="btn-admin btn-reject" style="background:#64748b;">Cancelar</a>
            <?php endif; ?>
        </div>
    </form>
</div>

<hr style="margin: 30px 0; border: 0; border-top: 1px solid #e2e8f0;">

<div class="card" style="padding: 0; overflow: hidden;">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Objeto</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($objetos)): ?>
                <tr><td colspan="4" class="empty-state">No hay objetos registrados.</td></tr>
            <?php else: ?>
                <?php foreach ($objetos as $o): ?>
                <tr>
                    <td class="objeto-nombre"><?= htmlspecialchars($o['nombre']) ?></td>
                    <td class="objeto-desc"><?= htmlspecialchars($o['descripcion']) ?></td>
                    <td>
                        <span class="status-badge <?= $o['disponible'] ? 'status-disponible' : 'status-prestado' ?>">
                            <?= $o['disponible'] ? 'Disponible' : 'Prestado' ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="admin.php?action=toggle_estado&id=<?= $o['id'] ?>" 
                               class="btn-admin" style="background: #64748b;" title="Cambiar Estado">Cambiar estado</a>
                            
                            <a href="admin.php?seccion=objetos&edit_id=<?= $o['id'] ?>" 
                               class="btn-admin btn-approve">Editar</a>
                            
                            <a href="admin.php?action=eliminar_objeto&id=<?= $o['id'] ?>" 
                               class="btn-admin btn-reject" 
                               onclick="return confirm('¿Eliminar este objeto?')">Eliminar</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>