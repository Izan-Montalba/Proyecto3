<?php
class AuthController 
{
    public function inicio() {
        $action = $_GET['action'] ?? 'mostrar';
        if ($action === 'procesar_login') {
            $this->procesarLogin();
        } else {
            $this->mostrarLogin();
        }
    }

    private function mostrarLogin() {
        require_once './app/views/login.php';
    }

    private function procesarLogin() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            try {
                $db = conectar(); 
                $modelo = new Usuario($db);
                $usuario = $modelo->buscarPorEmail($email);

                if ($usuario && $password === $usuario['password']) {
                    
                    if ($usuario['estado'] === 'pendiente') 
                    {
                        $error = "Tu cuenta aún está pendiente de aprobación por el administrador.";
                        require_once './app/views/login.php';
                        return; 
                    }

                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['rol'] = $usuario['rol'] ?? 'vecino';

                    if ($_SESSION['rol'] === 'admin') {
                        header("Location: admin.php");
                    } else {
                        header("Location: home.php");
                    }
                    exit();
                } else {
                    $error = "Correo o contraseña incorrectos";
                    require_once './app/views/login.php';
                }
            } catch (Exception $e) {
                die("Error en el servidor: " . $e->getMessage());
            }
        }
    }
}