<?php
session_start();
require '../../scriptControl/db/db.php';

header('Content-Type: application/json'); // Asegura que la respuesta sea JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asegurarse de que se haya recibido el ID de la oferta
    $data = json_decode(file_get_contents('php://input'), true); // Obtener datos JSON

    if (isset($data['id']) && !empty($data['id'])) {
        $oferta_id = $data['id'];

        try {
            // Preparar la consulta para eliminar la oferta
            $stmt = $pdo->prepare("DELETE FROM ofertas_empleo WHERE id = ?");
            $stmt->execute([$oferta_id]);

            // Verificar si se eliminó alguna fila
            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Oferta eliminada correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se encontró la oferta para eliminar.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar la oferta: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID de oferta no proporcionado.']);
    }
}
?>
