<?php
require_once 'config/database.php';
require_once 'app/models/Anuncio.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

$db = conectar();
$modeloAnuncio = new Anuncio($db);
$anuncios = $modeloAnuncio->listarTodos(); // Traemos los anuncios de la DB

require_once 'app/views/home_view.php';