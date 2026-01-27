<h1>📢 Tablón de Anuncios</h1>
<p>Mantente al día con lo que sucede en tu comunidad.</p>

<?php if (empty($anuncios)): ?>
    <div class="card">
        <p>No hay avisos nuevos en este momento.</p>
    </div>
<?php else: ?>
    <?php foreach ($anuncios as $a): ?>
        <div class="card">
            <small class="anuncio-fecha">
                <?= date('d/m/Y', strtotime($a['creado_en'])) ?>
            </small>
            <h3 class="anuncio-titulo">
                <?= htmlspecialchars($a['titulo']) ?>
            </h3>
            <p class="anuncio-contenido">
                <?= htmlspecialchars($a['contenido']) ?>
            </p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>