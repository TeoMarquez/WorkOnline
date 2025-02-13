<?php
session_start();
require '../../scriptControl/db/db.php';

header('Content-Type: application/json'); // Asegura que la respuesta sea JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados como JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar que el ID de la postulación esté presente
    if (isset($data['postulacion_id']) && !empty($data['postulacion_id'])) {
        $postulacion_id = $data['postulacion_id'];

        try {
            // Preparar la consulta para eliminar la postulación
            $stmt = $pdo->prepare("DELETE FROM postulaciones WHERE id = ?");
            $stmt->execute([$postulacion_id]);

            // Verificar si se eliminó alguna fila
            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Postulación retirada correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se encontró la postulación para retirar.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error al retirar la postulación: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID de postulación no proporcionado.']);
    }
}
?>
