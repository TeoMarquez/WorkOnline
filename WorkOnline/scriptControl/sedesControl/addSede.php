<?php
session_start();
require '../../scriptControl/db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empresa_id = $_POST['empresa_id'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];

    // Preparar la consulta para insertar la nueva sede
    $stmt = $pdo->prepare("INSERT INTO sedes (empresa_id, pais, ciudad) VALUES (?, ?, ?)");
    $stmt->execute([$empresa_id, $pais, $ciudad]);

    // Obtener el ID de la nueva sede
    $newSedeId = $pdo->lastInsertId();

    // Redirigir o enviar respuesta
    if ($stmt) {
        echo json_encode([
            'success' => true,
            'message' => 'Sede añadida correctamente.',
            'pais' => $pais,
            'ciudad' => $ciudad,
            'id' => $newSedeId // Devolver el ID de la nueva sede
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Hubo un error al añadir la sede.'
        ]);
    }
}
?>
