<?php
class Anuncio {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function listarTodos() {
        $stmt = $this->db->prepare("SELECT * FROM anuncios ORDER BY creado_en DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM anuncios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($titulo, $contenido) {
        $stmt = $this->db->prepare("INSERT INTO anuncios (titulo, contenido) VALUES (?, ?)");
        return $stmt->execute([$titulo, $contenido]);
    }

    public function actualizar($id, $titulo, $contenido) {
        $stmt = $this->db->prepare("UPDATE anuncios SET titulo = ?, contenido = ? WHERE id = ?");
        return $stmt->execute([$titulo, $contenido, $id]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM anuncios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}