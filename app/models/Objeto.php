<?php
class Objeto {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listarTodos() {
    // Esta consulta busca el objeto y le pega la última fecha_fin que encuentre en reservas
    $sql = "SELECT o.*, 
            (SELECT r.fecha_fin FROM reservas r WHERE r.objeto_id = o.id ORDER BY r.id DESC LIMIT 1) as fecha_fin
            FROM objetos o 
            ORDER BY o.nombre ASC";
    return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
    

    public function alquilar($objeto_id, $usuario_id, $fecha_fin) {
        try {

            $sqlReserva = "INSERT INTO reservas (objeto_id, usuario_id, fecha_inicio) VALUES (?, ?, NOW())";
            $sqlReserva = "INSERT INTO reservas (objeto_id, usuario_id, fecha_inicio, fecha_fin) VALUES (?, ?, NOW(), ?)";
            $stmt = $this->db->prepare($sqlReserva);
            $stmt->execute([$objeto_id, $usuario_id, $fecha_fin]);

            $sqlUpdate = "UPDATE objetos SET disponible = false WHERE id = ?";
            $stmtUpdate = $this->db->prepare($sqlUpdate);
            $stmtUpdate->execute([$objeto_id]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM objetos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $descripcion) {
        $stmt = $this->db->prepare("INSERT INTO objetos (nombre, descripcion, disponible) VALUES (?, ?, true)");
        return $stmt->execute([$nombre, $descripcion]);
    }

    public function actualizar($id, $nombre, $descripcion) {
        $stmt = $this->db->prepare("UPDATE objetos SET nombre = ?, descripcion = ? WHERE id = ?");
        return $stmt->execute([$nombre, $descripcion, $id]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM objetos WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function actualizarEstado($id, $estado) {
    $stmt = $this->db->prepare("UPDATE objetos SET disponible = $estado WHERE id = ?");
    return $stmt->execute([$id]);
}
}