<?php
class AuthController 
{


    public function inicio() {
        // Obtenemos la acción de la URL, si no hay, por defecto es 'mostrar'
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
                $db = conectar(); // Viene de config/database.php
                $modelo = new Usuario($db);
                $usuario = $modelo->buscarPorEmail($email);

                if ($usuario && password_verify($password, $usuario['password'])) {
                    $_SESSION['usuario_id'] = $usuario['id'];
                    header("Location: index.php?action=home");
                    exit();
                } else {
                    $error = "Usuario o contraseña incorrectos";
                    require_once 'app/views/auth/login.php';
                }
            } catch (Exception $e) {
                // Esto te ayudará a ver si el error es de la base de datos
                die("Error en el servidor: " . $e->getMessage());
            }
        }
    }

}