<?php
// Incluimos el archivo donde está la función (ajusta la ruta si es necesario)
require_once '../config/database.php';

echo "<h2>Probando conexión con Supabase...</h2>";

try {
    // Llamamos a la función
    $db = conectar();

    // Si llegamos aquí, la conexión técnica funciona. 
    // Ahora hagamos una mini-consulta para estar 100% seguros.
    $query = $db->query("SELECT current_database(), now();");
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    echo "<p style='color: green; font-weight: bold;'>
            ✅ ¡ÉXITO! Te has conectado correctamente.
          </p>";
    
    echo "<ul>
            <li><b>Base de datos:</b> " . $resultado['current_database'] . "</li>
            <li><b>Hora del servidor Supabase:</b> " . $resultado['now'] . "</li>
          </ul>";

} catch (Exception $e) {
    echo "<p style='color: red; font-weight: bold;'>
            ❌ ERROR: No se pudo conectar.
          </p>";
    echo "<p>Detalle del error: " . $e->getMessage() . "</p>";
}