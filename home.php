<?php
require_once 'config/database.php';
require_once 'app/models/Anuncio.php';
require_once 'app/models/Usuario.php';

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

$db = conectar();
$modeloUser = new Usuario($db);
$user = $modeloUser->buscarPorId($_SESSION['usuario_id']);

// Bloqueo si sigue pendiente
if ($user['estado'] === 'pendiente') {
    session_destroy();
    header("Location: index.php?error=pendiente");
    exit();
}

$modeloAnuncio = new Anuncio($db);
$anuncios = $modeloAnuncio->listarTodos();

require_once 'app/views/home_view.php';