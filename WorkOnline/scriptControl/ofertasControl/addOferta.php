<?php
require '../../scriptControl/db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos enviados del formulario
    $empresa_id = $_POST['empresa_id'];
    $titulo_oferta = $_POST['titulo_oferta'];
    $descripcion_oferta = $_POST['descripcion_oferta'];
    $rol = $_POST['rol'];
    $sueldo = $_POST['sueldo'];
    $carga_horaria = $_POST['carga_horaria'];
    $tipo = $_POST['tipo'];
    $fecha_cierre = $_POST['fecha_cierre'] ?? null;

    try {
        // Preparar la consulta para insertar los datos
        $query = "INSERT INTO ofertas_empleo 
                    (empresa_id, titulo_oferta, descripcion_oferta, rol, sueldo, carga_horaria, tipo, fecha_cierre) 
                  VALUES 
                    (:empresa_id, :titulo_oferta, :descripcion_oferta, :rol, :sueldo, :carga_horaria, :tipo, :fecha_cierre)";
        
        $stmt = $pdo->prepare($query);
        
        // Vincular los parámetros con los valores
        $stmt->bindParam(':empresa_id', $empresa_id);
        $stmt->bindParam(':titulo_oferta', $titulo_oferta);
        $stmt->bindParam(':descripcion_oferta', $descripcion_oferta);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':sueldo', $sueldo);
        $stmt->bindParam(':carga_horaria', $carga_horaria);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':fecha_cierre', $fecha_cierre);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'titulo_oferta' => $titulo_oferta,
                'descripcion_oferta' => $descripcion_oferta,
                'rol' => $rol,
                'sueldo' => $sueldo,
                'carga_horaria' => $carga_horaria,
                'tipo' => $tipo,
                'fecha_publicacion' => date('Y-m-d H:i:s'),
                'fecha_cierre' => $fecha_cierre ?? 'Sin fecha de cierre'
            ];
        } else {
            throw new Exception('Error al insertar la oferta.');
        }
    } catch (Exception $e) {
        $response = [
            'success' => false,
            'message' => $e->getMessage()
        ];
    }

    // Enviar la respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
