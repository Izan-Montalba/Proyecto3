<?php
class Evento {
    private $db;
    public function __construct($db) { 
        $this->db = $db; 
    }

    public function listarEventos() {
        $sql = "SELECT * FROM eventos WHERE fecha >= CURRENT_DATE ORDER BY fecha ASC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}