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
            $this->db->beginTransaction();

            $sqlReserva = "INSERT INTO reservas (objeto_id, usuario_id, fecha_reserva) VALUES (?, ?, NOW())";
            $stmt = $this->db->prepare($sqlReserva);
            $stmt->execute([$usuario_id, $objeto_id]);

            $sqlUpdate = "UPDATE objetos SET disponible = false WHERE id = ?";
            $stmtUpdate = $this->db->prepare($sqlUpdate);
            $stmtUpdate->execute([$objeto_id]);
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}