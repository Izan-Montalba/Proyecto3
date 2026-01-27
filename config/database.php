<?php
// config/database.php

function conectar() {
    $host     = "aws-1-eu-west-2.pooler.supabase.com";
    $port     = "6543";
    $db_name  = "postgres";
    $username = "postgres.ktmalofxngtaakkrfngw";
    $password = "pXEQlH46UueyR";

    try {
        // Creamos la conexión
        $db = new PDO(
            "pgsql:host=$host;port=$port;dbname=$db_name",
            $username,
            $password
        );
        
        // Configuramos para que lance excepciones en caso de error
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Devolvemos el "mando a distancia" de la base de datos
        return $db;

    } catch (PDOException $e) {
        // Si falla, detenemos la ejecución y avisamos
        die("Error de conexión: " . $e->getMessage());
    }
}