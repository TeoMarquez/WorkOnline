<?php
session_start(); // Asegúrate de que la sesión esté iniciada

require '../../scriptControl/db/db.php';

// Verificar si el usuario es una empresa
if (!isset($_SESSION['empresa'])) {
    echo json_encode(['error' => 'No autorizado']);
    exit;
}

// Obtener datos JSON del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Verificar que se recibieron los parámetros esperados
if (isset($data['postulacion_id']) && isset($data['nuevo_estado'])) {
    $postulacion_id = $data['postulacion_id'];
    $nuevo_estado = $data['nuevo_estado'];

    // Validar que el estado es uno de los tres posibles
    if (!in_array($nuevo_estado, ['aceptada', 'pendiente', 'rechazada'])) {
        echo json_encode(['error' => 'Estado no válido']);
        exit;
    }

    // Verificar que la postulación existe
    $stmt = $pdo->prepare("SELECT id FROM postulaciones WHERE id = ?");
    $stmt->execute([$postulacion_id]);
    if ($stmt->rowCount() === 0) {
        echo json_encode(['error' => 'Postulación no encontrada']);
        exit;
    }

    // Actualizar el estado de la postulación
    $stmt = $pdo->prepare("UPDATE postulaciones SET estado = ? WHERE id = ?");
    $stmt->execute([$nuevo_estado, $postulacion_id]);

    if ($stmt->rowCount()) {
        echo json_encode(['success' => 'Estado actualizado']);
    } else {
        echo json_encode(['error' => 'No se pudo actualizar el estado']);
    }
} else {
    echo json_encode(['error' => 'Datos incompletos']);
}
?>
