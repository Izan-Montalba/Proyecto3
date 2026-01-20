<?php
require_once 'config/database.php';
require_once 'app/models/Anuncio.php';
require_once 'app/models/Objeto.php';

$db = conectar();
$modeloObjeto = new Objeto($db);

// LÓGICA PARA ALQUILAR
if (isset($_GET['action']) && $_GET['action'] === 'alquilar') {
    $id_obj = $_GET['id'];
    $id_user = $_SESSION['usuario_id'];
    
    if ($modeloObjeto->alquilar($id_obj, $id_user)) {
        header("Location: home.php?seccion=objetos&status=success");
    } else {
        header("Location: home.php?seccion=objetos&status=error");
    }
    exit();
}

// Carga de datos para la vista
$seccion = $_GET['seccion'] ?? 'tablon';
if ($seccion === 'objetos') {
    $datosObjetos = $modeloObjeto->listarTodos();
}

require_once 'app/views/home_view.php';

