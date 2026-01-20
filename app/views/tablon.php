<h1>📢 Tablón de Anuncios</h1>
<p>Mantente al día con lo que sucede en tu comunidad.</p>

<?php if (empty($anuncios)): ?>
    <div class="card">
        <p>No hay avisos nuevos en este momento.</p>
    </div>
<?php else: ?>
    <?php foreach ($anuncios as $a): ?>
        <div class="card">
            <small style="color: #64748b; font-weight: 500;"><?= date('d/m/Y', strtotime($a['fecha_publicacion'])) ?></small>
            <h3 style="margin: 10px 0;"><?= htmlspecialchars($a['titulo']) ?></h3>
            <p><?= nl2br(htmlspecialchars($a['contenido'])) ?></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>