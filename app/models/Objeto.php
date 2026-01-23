<?php
class Objeto {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listarTodos() {
        $sql = "SELECT * FROM objetos ORDER BY nombre ASC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function alquilar($objeto_id, $usuario_id) {
        try {

            $sqlReserva = "INSERT INTO reservas (objeto_id, usuario_id, fecha_inicio) VALUES (?, ?, NOW())";
            $stmt = $this->db->prepare($sqlReserva);
            $stmt->execute([$objeto_id, $usuario_id]);

            $sqlUpdate = "UPDATE objetos SET disponible = false WHERE id = ?";
            $stmtUpdate = $this->db->prepare($sqlUpdate);
            $stmtUpdate->execute([$objeto_id]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}