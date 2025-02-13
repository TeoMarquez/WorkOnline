<?php
session_start(); // Aseguramos que la sesión esté iniciada
require '../../scriptControl/db/db.php';


// Verificamos si la sesión contiene el usuario o empresa que debe estar logueado
if (!isset($_SESSION['user']) && !isset($_SESSION['empresa'])) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Debes iniciar sesión para postularte.']);
    exit();
}

try {
    if (isset($_POST['oferta_id'])) {
        $oferta_id = $_POST['oferta_id'];
        
        // Si está logueado como usuario
        if (isset($_SESSION['user'])) {
            $usuario_id = $_SESSION['user']['id']; // Cambié 'usuario_id' por 'user'
        } else {
            $usuario_id = null;
        }

        // Consultar si la oferta existe
        $stmt = $pdo->prepare("SELECT * FROM ofertas_empleo WHERE id = :oferta_id");
        $stmt->bindValue(':oferta_id', $oferta_id, PDO::PARAM_INT);
        $stmt->execute();
        $oferta = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($oferta) {
            // Verificar si el usuario ya ha postulado a esta oferta
            $stmt = $pdo->prepare("SELECT * FROM postulaciones WHERE usuario_id = :usuario_id AND oferta_empleo_id = :oferta_id");
            $stmt->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $stmt->bindValue(':oferta_id', $oferta_id, PDO::PARAM_INT);
            $stmt->execute();
            $postulacionExistente = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($postulacionExistente) {
                echo json_encode(['status' => 'error', 'message' => 'Ya has postulado a esta oferta.']);
            } else {
                // Si no ha postulado, proceder con la postulación
                $stmt = $pdo->prepare("INSERT INTO postulaciones (usuario_id, empresa_id, oferta_empleo_id, estado) 
                                       VALUES (:usuario_id, :empresa_id, :oferta_empleo_id, 'pendiente')");
                $stmt->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
                $stmt->bindValue(':empresa_id', $oferta['empresa_id'], PDO::PARAM_INT);
                $stmt->bindValue(':oferta_empleo_id', $oferta_id, PDO::PARAM_INT);
                $stmt->execute();

                echo json_encode(['status' => 'success', 'message' => 'Tu postulación ha sido enviada con éxito.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'La oferta de empleo no existe.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se especificó la oferta.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Hubo un problema al procesar tu postulación.']);
}
?>