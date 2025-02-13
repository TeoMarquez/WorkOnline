<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postulación</title>
    <link rel="stylesheet" href="../css/postulacion.css">
    <script src="../js/postulacion.js"></script>

</head>
<body>
 
    <?php include './fragmento/header.php'; ?>


    <section class="postulacion">
        <h2>Formulario de Postulación</h2>
        <form action="postulacion.php" method="POST" enctype="multipart/form-data">
        
            <fieldset>
                <legend>Información Personal</legend>
                <label for="nombre">Nombre Completo:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" placeholder="Tu correo electrónico" required>

                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" placeholder="Tu número de teléfono" required>
            </fieldset>

        
            <fieldset>
                <legend>Información Profesional</legend>
                <label for="cv">Cargar CV (PDF):</label>
                <input type="file" id="cv" name="cv" accept=".pdf" required>

                <label for="experiencia">Experiencia Laboral:</label>
                <textarea id="experiencia" name="experiencia" rows="4" placeholder="Describe brevemente tu experiencia laboral" required></textarea>

                <label for="oferta">Oferta de Empleo:</label>
                <select id="oferta" name="oferta" required>
                    <option value="">Selecciona una oferta</option>
                    <option value="desarrollador">Desarrollador Web</option>
                    <option value="diseñador">Diseñador Gráfico</option>
                </select>
            </fieldset>

         
            <button type="submit" class="btn-postular">Enviar Postulación</button>
        </form>
    </section>

    <?php include './fragmento/footer.php'; ?>

</body>
</html>
