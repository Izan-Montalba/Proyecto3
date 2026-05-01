<div class="admin-header">
    <h1>📋 Historial de Préstamos</h1>
    <p>Consulta todos los alquileres realizados por los vecinos y su estado actual.</p>
</div>

<div class="admin-card" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <table class="admin-table" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                <th style="padding: 12px; text-align: left;">Vecino</th>
                <th style="padding: 12px; text-align: left;">Objeto</th>
                <th style="padding: 12px; text-align: left;">Desde</th>
                <th style="padding: 12px; text-align: left;">Hasta</th>
                <th style="padding: 12px; text-align: left;">Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($historial)): ?>
                <tr>
                    <td colspan="5" style="padding: 20px; text-align: center; color: #666;">
                        No hay registros de alquileres en el historial.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($historial as $h): 
                    $hoy = date('Y-m-d');
                    // Si la fecha de fin es menor que hoy y el objeto no está disponible, está fuera de plazo
                    $vencido = ($h['fecha_fin'] < $hoy && !$h['disponible']);
                ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px;"><strong><?= htmlspecialchars($h['usuario_nombre']) ?></strong></td>
                    <td style="padding: 12px;"><?= htmlspecialchars($h['objeto_nombre']) ?></td>
                    <td style="padding: 12px;"><?= date('d/m/Y', strtotime($h['fecha_inicio'])) ?></td>
                    <td style="padding: 12px;"><?= date('d/m/Y', strtotime($h['fecha_fin'])) ?></td>
                    <td style="padding: 12px;">
                        <?php if ($vencido): ?>
                            <span style="color: #721c24; background: #f8d7da; padding: 4px 8px; border-radius: 4px; font-size: 0.85em; font-weight: bold;">
                                ⚠️ Retrasado
                            </span>
                        <?php elseif (!$h['disponible']): ?>
                            <span style="color: #856404; background: #fff3cd; padding: 4px 8px; border-radius: 4px; font-size: 0.85em;">
                                ⏳ En uso
                            </span>
                        <?php else: ?>
                            <span style="color: #155724; background: #d4edda; padding: 4px 8px; border-radius: 4px; font-size: 0.85em;">
                                ✅ Devuelto
                            </span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>