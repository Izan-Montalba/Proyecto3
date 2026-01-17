<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

if ($usuario['estado'] === 'pendiente') {
    echo "Tu cuenta está esperando validación del administrador. Te avisaremos pronto.";
    exit();
}

require_once './app/views/home_view.php';

