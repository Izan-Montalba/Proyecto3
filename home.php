<?php
require_once 'config/database.php';
require_once 'app/models/Anuncio.php';

session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: index.php"); exit(); }

$db = conectar();
$seccion = $_GET['seccion'] ?? 'tablon';

$anuncios = [];
if ($seccion == 'tablon') {
    $modelo = new Anuncio($db);
    $anuncios = $modelo->listarTodos();
}

require_once 'app/views/home_view.php';