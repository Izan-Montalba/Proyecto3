<?php
// index.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';
require_once 'app/controllers/AuthController.php';
require_once 'app/models/Usuario.php';

session_start();

// Si ya está logueado, lo mandamos directo a su sitio sin pasar por el login
if (isset($_SESSION['usuario_id'])) {
    if ($_SESSION['rol'] === 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: home.php");
    }
    exit();
}

$auth = new AuthController();
$auth->inicio();