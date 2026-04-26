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

    $sql = "INSERT INTO usuarios (nombre, email, piso, rol, estado, password, puerta) 
            VALUES (?, ?, ?, 'vecino', 'pendiente', ?, ?)";
    
    $stmt = $this->db->prepare($sql);

    return $stmt->execute([ $nombre,$email, $piso,$password, $puerta]);
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

    public function eliminar($id) {
    $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
    return $stmt->execute([$id]);
    }

    // Mailer
    // app/models/Usuario.php

    public function obtenerEmailAdmin() {
        $sql = "SELECT email FROM usuarios WHERE rol = 'admin' LIMIT 1";
        $stmt = $this->db->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['email'] : null;
    }

    public function obtenerPorId($id) {
        $sql = "SELECT nombre, email FROM usuarios WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}