<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar Oferta de Empleo</title>
    <link rel="stylesheet" href="../css/Publicacion_Empleo.css">
</head>
<body>

    <?php include './fragmento/header.php'; ?>


    <main class="container">
        <h1>Publicar una Oferta de Empleo</h1>
        <form id="formPublicacion" enctype="multipart/form-data">
            <div class="form-section">
                <label for="titulo">Título de la Oferta</label>
                <input type="text" id="titulo" name="titulo" placeholder="Ejemplo: Desarrollador Web" required>
            </div>

            <div class="form-section">
                <label for="descripcion">Descripción del Puesto</label>
                <textarea id="descripcion" name="descripcion" rows="5" placeholder="Describe el puesto, requisitos y responsabilidades." required></textarea>
            </div>

            <div class="form-section">
                <label for="categoria">Categoría</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Seleccionar categoría</option>
                    <option value="tecnologia">Tecnología</option>
                    <option value="marketing">Marketing</option>
                    <option value="ventas">Ventas</option>
                    <option value="finanzas">Finanzas</option>
                    <option value="diseño">Diseño</option>
                </select>
            </div>

            <div class="form-section">
                <label for="ubicacion">Ubicación</label>
                <input type="text" id="ubicacion" name="ubicacion" placeholder="Ciudad, Estado o Región" required>
            </div>

            <div class="form-section">
                <label for="salario">Salario</label>
                <input type="number" id="salario" name="salario" placeholder="Ejemplo: 1500" required>
            </div>

            <div class="form-section">
                <label for="tipoTrabajo">Tipo de Trabajo</label>
                <select id="tipoTrabajo" name="tipoTrabajo" required>
                    <option value="tiempoCompleto">Tiempo Completo</option>
                    <option value="medioTiempo">Medio Tiempo</option>
                    <option value="freelance">Freelance</option>
                    <option value="practicas">Prácticas</option>
                </select>
            </div>

            <div class="form-section">
                <label for="fechaLimite">Fecha Límite de Postulación</label>
                <input type="date" id="fechaLimite" name="fechaLimite" required>
            </div>

            <div class="form-section">
                <label for="archivo">Adjuntar Archivo (opcional)</label>
                <input type="file" id="archivo" name="archivo" accept=".pdf, .docx, .jpg, .png">
            </div>

            <div class="form-section">
                <button type="submit" id="submitBtn">Publicar Oferta</button>
            </div>
        </form>

        <div id="previewSection" class="preview">
            <h2>Vista Previa</h2>
            <div id="previewContent"></div>
        </div>
    </main>

    <?php include './fragmento/footer.php'; ?>

    <script src="../js/Publicacion_Empleo.js"></script>

    <style>
        header h1{
            color:white;
        }
    </style>
</body>
</html>
