<?php
// Usamos __DIR__ para que la ruta sea absoluta desde la ubicación de este archivo
require_once __DIR__ . '/../lib/PHPMailer/Exception.php';
require_once __DIR__ . '/../lib/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../lib/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Notificador {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host       = 'smtp.gmail.com';
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = 'izanmontalba252@gmail.com'; 
        $this->mail->Password   = 'lnnz jngr kzbu iraj'; 
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port       = 587;
        
        $this->mail->setFrom('izanmontalba252@gmail.com', 'Gestión Vecinal');
        $this->mail->isHTML(true);
    $this->mail->CharSet = 'UTF-8';
    }

    // Aviso al Administrador: Se dispara al terminar el registro
    public function avisarRegistroAdmin($emailAdmin, $nombreVecino, $piso, $puerta) {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($emailAdmin);
            $this->mail->Subject = 'Nueva solicitud: ' . $nombreVecino;
            $this->mail->Body = "
                <div style='font-family: sans-serif; border: 1px solid #e2e8f0; padding: 20px; border-radius: 12px;'>
                    <h2 style='color: #1a68d1;'>Nueva solicitud de acceso</h2>
                    <p>Un nuevo vecino se ha registrado y está esperando validación:</p>
                    <ul>
                        <li><b>Nombre:</b> $nombreVecino</li>
                        <li><b>Vivienda:</b> Piso $piso, Puerta $puerta</li>
                    </ul>
                    <p>Puedes validarlo desde el panel de administración.</p>
                </div>";
            $this->mail->send();
        } catch (Exception $e) { return false; }
    }

    // Aviso al Vecino: Se dispara cuando el admin aprueba/rechaza
    public function avisarResultadoVecino($emailVecino, $nombreVecino, $aprobado) {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($emailVecino);
            $this->mail->Subject = $aprobado ? '¡Acceso aprobado!' : 'Estado de tu solicitud';
            
            $mensaje = $aprobado 
                ? "Tu cuenta ha sido validada correctamente. Ya puedes acceder al tablón y al chat."
                : "Lo sentimos, tu solicitud de acceso ha sido rechazada por el administrador.";
            
            $color = $aprobado ? "#10b981" : "#ef4444";

            $this->mail->Body = "
                <div style='font-family: sans-serif; border: 1px solid #e2e8f0; padding: 20px; border-radius: 12px;'>
                    <h2 style='color: $color;'>" . ($aprobado ? '¡Bienvenido!' : 'Solicitud revisada') . "</h2>
                    <p>Hola $nombreVecino,</p>
                    <p>$mensaje</p>
                </div>";
            $this->mail->send();
        } catch (Exception $e) { return false; }
    }
}