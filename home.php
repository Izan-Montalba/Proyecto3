<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'config/database.php';
require_once 'app/models/Anuncio.php';
require_once 'app/models/Objeto.php'; 
require_once 'app/models/Chat.php';
require_once 'app/models/Evento.php';

session_start();
$db = conectar();

// ALQUILER 
if (isset($_GET['action']) && $_GET['action'] === 'alquilar' && isset($_GET['id'])) {
    $id_objeto = $_GET['id'];
    $id_usuario = $_SESSION['usuario_id'];
    $fecha_fin = $_GET['fecha_fin'];

    $modeloObjeto = new Objeto($db);
    $resultado = $modeloObjeto->alquilar($id_objeto, $id_usuario, $fecha_fin);

    if ($resultado) {
        header("Location: home.php?seccion=objetos&reserva=ok");
    } else {
        header("Location: home.php?seccion=objetos&reserva=error");
    }
    exit();
}

// Acción de enviar
if (isset($_GET['action']) && $_GET['action'] === 'enviar_mensaje' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $chat = new Chat($db);
    $chat->enviar($_SESSION['usuario_id'], $_POST['mensaje']);
    header("Location: home.php?seccion=chat");
    exit();
}

$seccion = $_GET['seccion'] ?? 'tablon';

// Carga de datos según sección
// if ($seccion === 'tablon') {
//     $modelo = new Anuncio($db);
//     $anuncios = $modelo->listarTodos();
// } elseif ($seccion === 'objetos') {
//     $modelo = new Objeto($db);
//     $datosObjetos = $modelo->listarTodos();
// }elseif ($seccion === 'calendario') {
//     $modelo = new Evento($db);
//     $eventos = $modelo->listarEventos();
// }elseif ($seccion === 'chat') {
//     $chat = new Chat($db);
//     $mensajes = $chat->obtenerMensajes();
// }

switch ($seccion) {
    case 'tablon':
        $modelo = new Anuncio($db);
        $anuncios = $modelo->listarTodos();
        break;
    
    case 'objetos':
        $modelo = new Objeto($db);
        $datosObjetos = $modelo->listarTodos();
        break;
    
    case 'calendario':
        $modelo = new Evento($db);
        $eventos = $modelo->listarEventos();
        break;

    case 'chat':
        $chat = new Chat($db);
        $mensajes = $chat->obtenerMensajes();
        break;
}

require_once 'app/views/home_view.php';