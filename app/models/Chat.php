<?php
class Chat {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function obtenerMensajes() {
    // 1. Seleccionamos los últimos 50 mensajes (orden descendente)
    // 2. Luego ordenamos ese resultado de forma ascendente para que el chat se lea de arriba a abajo
    $sql = "SELECT * FROM (
                SELECT m.usuario_id, m.mensaje, m.enviado_en, u.nombre FROM mensajes_chat m 
                JOIN usuarios u ON m.usuario_id = u.id ORDER BY m.enviado_en DESC LIMIT 50
            ) AS subconsulta ORDER BY enviado_en ASC";

    return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

    public function enviar($usuario_id, $mensaje) {
        $sql = "INSERT INTO mensajes_chat (usuario_id, mensaje) VALUES (?, ?)";
        return $this->db->prepare($sql)->execute([$usuario_id, $mensaje]);
    }
} 