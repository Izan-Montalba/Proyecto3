<link rel="stylesheet" href="public/css/calendario.css">

<h1>📅 Calendario de la Comunidad</h1>
<p>Próximos eventos y fechas importantes.</p>

<div class="timeline">
    <?php if (empty($eventos)): ?>
        <div class="card">
            <p>No hay eventos programados próximamente.</p>
        </div>
    <?php else: ?>
        <?php foreach ($eventos as $e): ?>
            <div class="timeline-item <?= htmlspecialchars($e['tipo']) ?>">
                <div class="timeline-date">
                    <span class="day"><?= date('d', strtotime($e['fecha'])) ?></span>
                    <span class="month"><?= date('M', strtotime($e['fecha'])) ?></span>
                </div>
                <div class="timeline-content card">
                    <span class="badge"><?= ucfirst($e['tipo']) ?></span>
                    <h3><?= htmlspecialchars($e['titulo']) ?></h3>
                    <p><?= htmlspecialchars($e['descripcion']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>