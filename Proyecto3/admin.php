<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}
// Carga la vista del administrador
require_once './app/views/admin_view.php';