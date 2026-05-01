<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';
require_once 'app/models/Usuario.php';
require_once 'app/models/Anuncio.php';
require_once 'app/models/Objeto.php';
require_once 'app/models/Notificador.php';

session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$db = conectar();
$modeloUsuario = new Usuario($db);
$modeloAnuncio = new Anuncio($db);
$modeloObjeto = new Objeto($db);
$notificador = new Notificador();

// --- ACCIONES ---
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'aprobar':
        if ($id) {
            $vecino = $modeloUsuario->obtenerPorId($id);
            if ($modeloUsuario->actualizarEstado($id, 'aprobado')) {
                if ($vecino) $notificador->avisarResultadoVecino($vecino['email'], $vecino['nombre'], true);
                header("Location: admin.php?seccion=validar&res=aprobado"); exit();
            }
        }
        break;

    case 'rechazar':
        if ($id) {
            $vecino = $modeloUsuario->obtenerPorId($id);
            if ($modeloUsuario->eliminar($id)) {
                if ($vecino) $notificador->avisarResultadoVecino($vecino['email'], $vecino['nombre'], false);
                header("Location: admin.php?seccion=validar&res=rechazado"); exit();
            }
        }
        break;

    case 'eliminar_anuncio':
        if ($id) {
            $modeloAnuncio->eliminar($id);
            header("Location: admin.php?seccion=anuncios"); exit();
        }
        break;

    case 'guardar_anuncio':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $contenido = $_POST['contenido'];
            $id_edit = $_POST['id_anuncio'] ?? null;
            $id_edit ? $modeloAnuncio->actualizar($id_edit, $titulo, $contenido) : $modeloAnuncio->crear($titulo, $contenido);
            header("Location: admin.php?seccion=anuncios"); exit();
        }
        break;

    case 'toggle_estado':
        if ($id) {
            $obj = $modeloObjeto->buscarPorId($id);
            $nuevoEstado = $obj['disponible'] ? 'false' : 'true';
            $modeloObjeto->actualizarEstado($id, $nuevoEstado);
            header("Location: admin.php?seccion=objetos"); exit();
        }
        break;

    case 'guardar_objeto':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $id_edit = $_POST['id_objeto'] ?? null;
            $id_edit ? $modeloObjeto->actualizar($id_edit, $nombre, $descripcion) : $modeloObjeto->crear($nombre, $descripcion);
            header("Location: admin.php?seccion=objetos"); exit();
        }
        break;
}

// --- CARGA DE DATOS SEGÚN SECCIÓN (SWITCH) ---
$seccion = $_GET['seccion'] ?? 'inicio';
$anuncioEditar = null;
$objetoEditar = null;
$historial = [];

switch ($seccion) {
    case 'validar':
        $pendientes = $modeloUsuario->obtenerPendientes();
        break;

    case 'anuncios':
        $anuncios = $modeloAnuncio->listarTodos();
        if (isset($_GET['edit_id'])) {
            $anuncioEditar = $modeloAnuncio->buscarPorId($_GET['edit_id']);
        }
        break;

    case 'objetos':
        $objetos = $modeloObjeto->listarTodos();
        if (isset($_GET['edit_id'])) {
            $objetoEditar = $modeloObjeto->buscarPorId($_GET['edit_id']);
        }
        break;
    case 'historial':
    $filtroVecino = $_GET['vecino'] ?? '';
    $filtroObjeto = $_GET['objeto'] ?? '';
    

    $historial = $modeloObjeto->listarHistorialFiltrado($filtroVecino, $filtroObjeto);
    break;;
}

require_once './app/views/admin_view.php';