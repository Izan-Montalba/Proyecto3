<h1>🛠️ Alquiler de Objetos</h1>
<p>Selecciona un objeto para reservarlo. Se marcará automáticamente como no disponible.</p>

<?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <div style="color: green; margin-bottom: 15px;">¡Reserva realizada correctamente!</div>
<?php endif; ?>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; border-bottom: 2px solid #eee;">
                <th style="padding: 12px;">Nombre</th>
                <th style="padding: 12px;">Descripción</th>
                <th style="padding: 12px;">Estado</th>
                <th style="padding: 12px;">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datosObjetos as $obj): ?>
            <tr style="border-bottom: 1px solid #f9f9f9;">
                <td style="padding: 12px;"><strong><?= htmlspecialchars($obj['nombre']) ?></strong></td>
                <td style="padding: 12px;"><?= htmlspecialchars($obj['descripcion']) ?></td>
                <td style="padding: 12px;">
                    <?php if($obj['disponible']): ?>
                        <span style="color: #10b981;">● Disponible</span>
                    <?php else: ?>
                        <span style="color: #f87171;">● Prestado</span>
                    <?php endif; ?>
                </td>
                <td style="padding: 12px;">
                    <?php if($obj['disponible']): ?>
                        <button style="background: var(--primary); color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer;"
                                onclick="window.location.href='home.php?action=alquilar&id=<?= $obj['id'] ?>'">
                            Alquilar
                        </button>
                    <?php else: ?>
                        <button disabled style="background: #e2e8f0; color: #94a3b8; border: none; padding: 8px 15px; border-radius: 6px;">
                            No disponible
                        </button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>