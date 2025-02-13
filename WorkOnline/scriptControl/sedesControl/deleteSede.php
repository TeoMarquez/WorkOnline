<?php
session_start();
require '../../scriptControl/db/db.php';

header('Content-Type: application/json'); // Asegura que la respuesta sea JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $sede_id = $_POST['id'];

        try {
            // Preparar la consulta para eliminar la sede
            $stmt = $pdo->prepare("DELETE FROM sedes WHERE id = ?");
            $stmt->execute([$sede_id]);

            // Verificar si se eliminó alguna fila
            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Sede eliminada correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se encontró la sede para eliminar.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar la sede: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID de sede no proporcionado.']);
    }
}
?>
