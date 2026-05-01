<div class="admin-header">
    <h1>📋 Historial de Préstamos</h1>
</div>

<div class="card" style="margin-bottom: 20px; padding: 15px;">
    <form action="admin.php" method="GET" style="display: flex; gap: 10px;">
        <input type="hidden" name="seccion" value="historial">
        
        <input type="text" name="vecino" placeholder="Vecino..." 
               value="<?= htmlspecialchars($_GET['vecino'] ?? '') ?>">
        
        <input type="text" name="objeto" placeholder="Producto..." 
               value="<?= htmlspecialchars($_GET['objeto'] ?? '') ?>">
        
        <button type="submit" class="btn-admin">🔍 Filtrar</button>
        <a href="admin.php?seccion=historial" class="btn-admin" style="background:#6c757d; text-decoration:none;">Limpiar</a>
    </form>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Vecino</th>
                <th>Objeto</th>
                <th>Desde</th>
                <th>Hasta</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($historial as $h): ?>
                <?php

                    $hoy = date('Y-m-d');
                    $fecha_entrega = date('Y-m-d', strtotime($h['fecha_fin']));
                    

                    $terminado = ($fecha_entrega < $hoy);
                ?>
                <tr>
                    <td><strong><?= htmlspecialchars($h['usuario_nombre']) ?></strong></td>
                    <td><?= htmlspecialchars($h['objeto_nombre']) ?></td>
                    <td><?= date('d/m/Y', strtotime($h['fecha_inicio'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($h['fecha_fin'])) ?></td>
                    <td>
                        <?php if ($terminado): ?>
                            <span style="color: #155724; background: #d4edda; padding: 4px 8px; border-radius: 4px; font-size: 0.85em;">
                                ✅ Finalizado
                            </span>
                        <?php else: ?>
                            <span style="color: #856404; background: #fff3cd; padding: 4px 8px; border-radius: 4px; font-size: 0.85em; font-weight: bold;">
                                ⏳ En uso
                            </span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>