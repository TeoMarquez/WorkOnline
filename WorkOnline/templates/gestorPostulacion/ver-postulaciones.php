<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Postulaciones</title>
    <link rel="stylesheet" href="../css/postulacion.css">
</head>
<body>
    <?php include './fragmento/header.php'; ?>

    <section class="ver-postulaciones">
        <h2>Listado de Postulantes</h2>

        <!-- Aquí puedes usar un bucle PHP para mostrar las postulaciones desde la base de datos -->
        <?php
        // Ejemplo de un arreglo de postulaciones para mostrar
        $postulaciones = [
            [
                'nombre' => 'Juan Pérez',
                'puesto' => 'Desarrollador Web',
                'ubicacion' => 'Ciudad X',
                'salario' => '$1500 - $2000 USD',
                'cv' => 'cv_juan.pdf',
                'estado' => 'Pendiente'
            ],
            [
                'nombre' => 'Ana Gómez',
                'puesto' => 'Diseñador Gráfico',
                'ubicacion' => 'Ciudad Y',
                'salario' => '$1200 - $1500 USD',
                'cv' => 'cv_ana.pdf',
                'estado' => 'Entrevista'
            ],
            [
                'nombre' => 'Carlos López',
                'puesto' => 'Analista de Datos',
                'ubicacion' => 'Ciudad Z',
                'salario' => '$2000 - $2500 USD',
                'cv' => 'cv_carlos.pdf',
                'estado' => 'Contratado'
            ],
            // Puedes agregar más postulaciones aquí
        ];

        // Mostrar cada postulación en una tabla
        foreach ($postulaciones as $postulante) {
            echo "
                <div class='postulacion'>
                    <h3>{$postulante['nombre']}</h3>
                    <p><strong>Puesto:</strong> {$postulante['puesto']}</p>
                    <p><strong>Ubicación:</strong> {$postulante['ubicacion']}</p>
                    <p><strong>Salario esperado:</strong> {$postulante['salario']}</p>
                    <p><strong>Estado de la postulación:</strong> {$postulante['estado']}</p>
                    <p><strong>CV:</strong> <a href='../uploads/{$postulante['cv']}' target='_blank'>Ver CV</a></p>
                    <a href='ver-detalles.php?postulante={$postulante['nombre']}' class='btn-ver-detalles'>Ver Detalles</a>
                </div>
            ";
        }
        ?>
        
    </section>

    <?php include './fragmento/footer.php'; ?>
</body>
</html>
