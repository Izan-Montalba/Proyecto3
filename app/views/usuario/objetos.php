<h1>🛠️ Alquiler de Objetos</h1>
<p>Selecciona un objeto y la fecha de devolución para reservarlo.</p>

<?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <div class="alert-success">
        ¡Reserva realizada correctamente! El objeto ya figura como prestado.
    </div>
<?php endif; ?>

<div class="card">
    <table class="tabla-objetos">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datosObjetos as $obj): ?>
            <tr>
                <td><strong><?= htmlspecialchars($obj['nombre']) ?></strong></td>
                <td><?= htmlspecialchars($obj['descripcion']) ?></td>
                <td>
                    <?php if($obj['disponible']): ?>
                        <span class="status-disponible">● Disponible</span>
                    <?php else: ?>
    <span class="status-prestado">● Prestado</span>
    <?php if(!empty($obj['fecha_fin'])): ?>
        <div style="margin-top: 5px; font-size: 0.85em; color: #d9534f; font-weight: bold;">
            Hasta: <?= date('d/m/Y', strtotime($obj['fecha_fin'])) ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
                </td>
                <td>
                    <?php if($obj['disponible']): ?>
                        <form action="home.php" method="GET" class="form-alquilar">
                            <input type="hidden" name="action" value="alquilar">
                            <input type="hidden" name="id" value="<?= $obj['id'] ?>">
                            
                            <input type="date" name="fecha_fin" class="input-fecha" 
                                   required min="<?= date('Y-m-d') ?>">
                            
                            <button type="submit" class="btn-alquilar">Alquilar</button>
                        </form>
                    <?php else: ?>
                        <button disabled class="btn-disabled">
                            No disponible
                        </button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>