<div class="admin-header">
    <h1>Gestión de Tablón</h1>
</div>

<div class="card form-anuncio">
    <h3><?= $anuncioEditar ? "Editar Anuncio" : "Nuevo Anuncio" ?></h3>
    <form action="admin.php?action=guardar_anuncio" method="POST">
        <?php if ($anuncioEditar): ?>
            <input type="hidden" name="id_anuncio" value="<?= $anuncioEditar['id'] ?>">
        <?php endif; ?>

        <div class="form-group">
            <input type="text" name="titulo" placeholder="Título del anuncio" 
                   value="<?= $anuncioEditar['titulo'] ?? '' ?>" required>
        </div>
        
        <div class="form-group">
            <textarea name="contenido" placeholder="Contenido del anuncio..." required><?= $anuncioEditar['contenido'] ?? '' ?></textarea>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn-admin btn-approve">
                <?= $anuncioEditar ? "Actualizar Anuncio" : "Publicar Anuncio" ?>
            </button>
            <?php if ($anuncioEditar): ?>
                <a href="admin.php?seccion=anuncios" class="btn-admin btn-reject">Cancelar</a>
            <?php endif; ?>
        </div>
    </form>
</div>

<hr>

<h2>Anuncios Existentes</h2>

<?php if (empty($anuncios)): ?>
    <div class="card">
        <p class="empty-state">No hay avisos publicados en este momento.</p>
    </div>
<?php else: ?>
    <?php foreach ($anuncios as $a): ?>
        <div class="card">
            <div class="anuncio-meta">
                <small class="anuncio-fecha"><?= date('d/m/Y', strtotime($a['creado_en'])) ?></small>
            </div>
            <h3 class="anuncio-titulo"><?= htmlspecialchars($a['titulo']) ?></h3>
            <p class="anuncio-contenido"><?= nl2br(htmlspecialchars($a['contenido'])) ?></p>
            
            <div class="btn-group">
                <a href="admin.php?seccion=anuncios&edit_id=<?= $a['id'] ?>" class="btn-admin btn-approve">Editar</a>
                
                <a href="admin.php?action=eliminar_anuncio&id=<?= $a['id'] ?>" 
                   class="btn-admin btn-reject" 
                   onclick="return confirm('¿Estás seguro de eliminar este anuncio?')">Eliminar</a>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>