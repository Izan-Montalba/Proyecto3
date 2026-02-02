<?php
require_once 'config/database.php';
require_once 'app/models/Usuario.php';

session_start();

// Seguridad: Solo admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$db = conectar();
$modeloUsuario = new Usuario($db);

// Lógica de acciones rápidas (Aprobar/Rechazar)
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_GET['action'] === 'aprobar') $modeloUsuario->actualizarEstado($id, 'activo');
    if ($_GET['action'] === 'rechazar') $modeloUsuario->actualizarEstado($id, 'rechazado');
    header("Location: admin.php?seccion=validar");
    exit();
}

// Determinar qué sección mostrar
$seccion = $_GET['seccion'] ?? 'inicio';

// Cargar datos según la sección
if ($seccion === 'validar') {
    $pendientes = $modeloUsuario->obtenerPendientes();
}

require_once './app/views/admin_view.php';