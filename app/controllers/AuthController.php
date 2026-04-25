<?php
class AuthController {
    public function inicio() {
        $action = $_GET['action'] ?? 'login';

        if ($action === 'procesar_login') {
            $this->procesarLogin();
        } elseif ($action === 'registro') {
            require_once './app/views/registro.php';
        } elseif ($action === 'procesar_registro') {
            $this->procesarRegistro();
        } else {
            require_once './app/views/login.php';
        }
    }

    private function procesarRegistro() {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $piso = $_POST['piso'];
        $puerta = $_POST['puerta'];

        $db = conectar();
        $modelo = new Usuario($db);
        
        if ($modelo->registrar($nombre, $email, $password, $piso, $puerta)) {
            $mensaje = "Registro enviado. El administrador debe aprobar tu cuenta.";
            require_once './app/views/login.php';
        } else {
            $error = "Error al registrarse.";
            require_once './app/views/registro.php';
        }
    }

    private function procesarLogin() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $db = conectar();
        $modelo = new Usuario($db);
        $usuario = $modelo->buscarPorEmail($email);

        if ($usuario && $password === $usuario['password']) {
            if ($usuario['estado'] === 'pendiente') {
                $error = "Tu cuenta aún no ha sido aprobada por el administrador.";
                require_once './app/views/login.php';
                return;
            }
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['rol'] = $usuario['rol'];
            header("Location: " . ($usuario['rol'] === 'admin' ? "admin.php" : "home.php"));
        } else {
            $error = "Credenciales incorrectas.";
            require_once './app/views/login.php';
        }
    }
}