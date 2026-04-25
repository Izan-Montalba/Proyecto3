<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'config/database.php';
require_once 'app/models/Usuario.php';
require_once 'app/models/Anuncio.php';
require_once 'app/models/Objeto.php';

session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$db = conectar();
$modeloUsuario = new Usuario($db);
$modeloAnuncio = new Anuncio($db);
$modeloObjeto = new Objeto($db);

// --- ACCIONES ---
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

if ($action === 'aprobar' && $id) {
    $modeloUsuario->actualizarEstado($id, 'aprobado');
    header("Location: admin.php?seccion=validar"); exit();
} 
elseif ($action === 'rechazar' && $id) {
    $modeloUsuario->eliminar($id);
    header("Location: admin.php?seccion=validar"); exit();
}

// Eliminar Anuncio
if ($action === 'eliminar_anuncio' && $id) {
    $modeloAnuncio->eliminar($id);
    header("Location: admin.php?seccion=anuncios"); exit();
}

// Guardar Anuncio (Crear o Editar)
if ($action === 'guardar_anuncio' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $id_edit = $_POST['id_anuncio'] ?? null;

    if ($id_edit) {
        $modeloAnuncio->actualizar($id_edit, $titulo, $contenido);
    } else {
        $modeloAnuncio->crear($titulo, $contenido);
    }
    header("Location: admin.php?seccion=anuncios"); exit();
}

if ($action === 'toggle_estado' && $id) {
    // Obtenemos el objeto actual para saber su estado
    $obj = $modeloObjeto->buscarPorId($id);
    // Invertimos el valor de disponible (si es true pasa a false, y viceversa)
    $nuevoEstado = $obj['disponible'] ? 'false' : 'true';
    
    $modeloObjeto->actualizarEstado($id, $nuevoEstado);
    header("Location: admin.php?seccion=objetos"); exit();
}

if ($action === 'guardar_objeto' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $id_edit = $_POST['id_objeto'] ?? null;

    if ($id_edit) {
        $modeloObjeto->actualizar($id_edit, $nombre, $descripcion);
    } else {
        $modeloObjeto->crear($nombre, $descripcion);
    }
    header("Location: admin.php?seccion=objetos"); exit();
}

// --- CARGA DE VISTAS ---
$seccion = $_GET['seccion'] ?? 'inicio';
$anuncioEditar = null;
$objetoEditar = null;

if ($seccion === 'validar') {
    $pendientes = $modeloUsuario->obtenerPendientes();
} elseif ($seccion === 'anuncios') {
    $anuncios = $modeloAnuncio->listarTodos();
    // Si venimos de dar clic a "Editar", cargamos el anuncio en el formulario
    if (isset($_GET['edit_id'])) {
        $anuncioEditar = $modeloAnuncio->buscarPorId($_GET['edit_id']);
    }
}elseif ($seccion === 'objetos') {
    $objetos = $modeloObjeto->listarTodos();
    if (isset($_GET['edit_id'])) $objetoEditar = $modeloObjeto->buscarPorId($_GET['edit_id']);
}

require_once './app/views/admin_view.php';