<?php
class Usuario {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function buscarPorEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre, $email, $password, $piso, $puerta) {
        $sql = "INSERT INTO usuarios (nombre, email, password, piso, puerta, estado, rol) 
                VALUES (?, ?, ?, ?, ?, 'pendiente', 'vecino')";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $email, $password, $piso, $puerta]);
    }

    public function obtenerPendientes() {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE estado = 'pendiente'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarEstado($id, $nuevoEstado) {
    $stmt = $this->db->prepare("UPDATE usuarios SET estado = ? WHERE id = ?");
    return $stmt->execute([$nuevoEstado, $id]);
}
}