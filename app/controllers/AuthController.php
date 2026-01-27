<?php
class AuthController {
    public function inicio() {
        if (isset($_GET['action']) && $_GET['action'] === 'procesar_login') {
            $this->procesarLogin();
        } else {
            require_once './app/views/login.php';
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
                $error = "Cuenta pendiente de aprobación.";
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