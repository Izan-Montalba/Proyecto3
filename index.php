<?php
require_once 'config/database.php';
require_once 'app/controllers/AuthController.php';
require_once 'app/models/Usuario.php';

session_start();

if (isset($_SESSION['usuario_id'])) {
    header("Location: " . ($_SESSION['rol'] === 'admin' ? "admin.php" : "home.php"));
    exit();
}

$auth = new AuthController();
$auth->inicio();