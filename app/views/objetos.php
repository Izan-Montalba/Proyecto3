<h1>🛠️ Alquiler de Objetos</h1>
<p>Selecciona un objeto para reservarlo. Se marcará automáticamente como no disponible.</p>

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
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($obj['disponible']): ?>
                        <button class="btn-alquilar" 
                                onclick="window.location.href='home.php?action=alquilar&id=<?= $obj['id'] ?>'">
                            Alquilar
                        </button>
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