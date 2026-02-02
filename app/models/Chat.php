<?php
class Chat {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function obtenerMensajes() {
        // $sql = "SELECT m.*, u.nombre nombre_usuario FROM mensajes_chat m JOIN usuarios u ON m.usuario_id = u.id ORDER BY m.enviado_en ASC LIMIT 50";
            $sql = "SELECT m.usuario_id, m.mensaje, m.enviado_en, u.nombre FROM mensajes_chat m JOIN usuarios u 
                ON m.usuario_id = u.id ORDER BY m.enviado_en ASC LIMIT 20";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function enviar($usuario_id, $mensaje) {
        $sql = "INSERT INTO mensajes_chat (usuario_id, mensaje) VALUES (?, ?)";
        return $this->db->prepare($sql)->execute([$usuario_id, $mensaje]);
    }
}