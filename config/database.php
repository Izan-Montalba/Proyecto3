<?php
// config/database.php

// function conectar() {
//     $host     = "aws-1-eu-west-2.pooler.supabase.com";
//     $port     = "6543";
//     $db_name  = "postgres";
//     $username = "postgres.ktmalofxngtaakkrfngw";
//     $password = "pXEQlH46UueyR";

//     try {
//         // Creamos la conexión
//         $db = new PDO(
//             "pgsql:host=$host;port=$port;dbname=$db_name",
//             $username,
//             $password
//         );
        
//         // Configuramos para que lance excepciones en caso de error
//         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
//         // Devolvemos el "mando a distancia" de la base de datos
//         return $db;

//     } catch (PDOException $e) {
//         // Si falla, detenemos la ejecución y avisamos
//         die("Error de conexión: " . $e->getMessage());
//     }
// }
// config/database.php

function conectar() {
    // Intentamos leer de las variables de entorno (Render), 
    // si no existen, usamos tus datos actuales (Local)
    $host     = getenv('DB_HOST')     ?: "aws-1-eu-west-2.pooler.supabase.com";
    $port     = getenv('DB_PORT')     ?: "6543";
    $db_name  = getenv('DB_NAME')     ?: "postgres";
    $username = getenv('DB_USER')     ?: "postgres.ktmalofxngtaakkrfngw";
    $password = getenv('DB_PASSWORD') ?: "pXEQlH46UueyR";

    try {
        $db = new PDO(
            "pgsql:host=$host;port=$port;dbname=$db_name",
            $username,
            $password
        );
        
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;

    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}