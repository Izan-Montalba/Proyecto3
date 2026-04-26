<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';
require_once 'app/models/Usuario.php';
require_once 'app/models/Anuncio.php';
require_once 'app/models/Objeto.php';
require_once 'app/models/Notificador.php'; // Cargamos el notificador

session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$db = conectar();
$modeloUsuario = new Usuario($db);
$modeloAnuncio = new Anuncio($db);
$modeloObjeto = new Objeto($db);
$notificador = new Notificador(); // Instanciamos el notificador

// --- ACCIONES ---
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

// Acción: Aprobar Vecino
if ($action === 'aprobar' && $id) {
    // 1. Buscamos los datos del vecino antes de cambiar nada para tener su email
    $vecino = $modeloUsuario->obtenerPorId($id);
    
    if ($modeloUsuario->actualizarEstado($id, 'aprobado')) {
        // 2. Si se actualizó bien, enviamos correo de bienvenida
        if ($vecino) {
            $notificador->avisarResultadoVecino($vecino['email'], $vecino['nombre'], true);
        }
        header("Location: admin.php?seccion=validar&res=aprobado"); exit();
    }
} 
// Acción: Rechazar Vecino
elseif ($action === 'rechazar' && $id) {
    // 1. Buscamos los datos antes de borrarlo de la base de datos
    $vecino = $modeloUsuario->obtenerPorId($id);
    
    if ($modeloUsuario->eliminar($id)) {
        // 2. Avisamos al correo del vecino que ha sido rechazado
        if ($vecino) {
            $notificador->avisarResultadoVecino($vecino['email'], $vecino['nombre'], false);
        }
        header("Location: admin.php?seccion=validar&res=rechazado"); exit();
    }
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
    $obj = $modeloObjeto->buscarPorId($id);
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
    if (isset($_GET['edit_id'])) {
        $anuncioEditar = $modeloAnuncio->buscarPorId($_GET['edit_id']);
    }
} elseif ($seccion === 'objetos') {
    $objetos = $modeloObjeto->listarTodos();
    if (isset($_GET['edit_id'])) {
        $objetoEditar = $modeloObjeto->buscarPorId($_GET['edit_id']);
    }
}

require_once './app/views/admin_view.php';