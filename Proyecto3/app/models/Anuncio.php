<?php
class Anuncio {
    private $db;
    public function __construct($conexion) { $this->db = $conexion; }

    public function listarTodos() {
        $stmt = $this->db->query("SELECT * FROM anuncios ORDER BY creado_en DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}