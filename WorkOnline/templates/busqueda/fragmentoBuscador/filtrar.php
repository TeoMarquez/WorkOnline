<?php
include '../../scriptControl/db/db.php';

// Redirigir si no se ha enviado ningún parámetro de búsqueda
if (empty($_GET['rol']) && empty($_GET['ubicacion']) && empty($_GET['tipo']) && empty($_GET['sueldo']) && empty($_GET['fecha'])) {
    header('Location: novedades.php');
    exit();
}

try {
    // Consulta base para obtener las ofertas de empleo junto con la información de la empresa y la ubicación
    $query = "SELECT o.*, e.nombre_completo AS nombre_empresa, s.ciudad 
          FROM ofertas_empleo o 
          JOIN empresas e ON o.empresa_id = e.id 
          JOIN sedes s ON e.id = s.empresa_id
          WHERE 1=1";

    // Aplicar filtros de búsqueda si existen
    if (!empty($_GET['rol'])) {
        $query .= " AND o.rol LIKE :rol"; // Cambié 'titulo' a 'rol'
    }
    if (!empty($_GET['ubicacion'])) {
        $query .= " AND s.ciudad = :ubicacion";
    }
    if (!empty($_GET['tipo'])) {
        $query .= " AND o.tipo = :tipo";
    }
    if (!empty($_GET['sueldo'])) {
        $query .= " AND o.sueldo >= :sueldo";
    }
    if (!empty($_GET['fecha'])) {
        $query .= " AND o.fecha_publicacion >= :fecha";
    }

    $stmt = $pdo->prepare($query);

    // Asignar los parámetros a la consulta
    if (!empty($_GET['rol'])) {
        $stmt->bindValue(':rol', '%' . $_GET['rol'] . '%');
    }
    if (!empty($_GET['ubicacion'])) {
        $stmt->bindValue(':ubicacion', $_GET['ubicacion']);
    }
    if (!empty($_GET['tipo'])) {
        $stmt->bindValue(':tipo', $_GET['tipo']);
    }
    if (!empty($_GET['sueldo'])) {
        $stmt->bindValue(':sueldo', $_GET['sueldo'], PDO::PARAM_INT);
    }
    if (!empty($_GET['fecha'])) {
        $stmt->bindValue(':fecha', $_GET['fecha']);
    }

    $stmt->execute();
    $ofertas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error en la conexión o en la consulta: " . $e->getMessage());
}
?>

<style>
    main{
        height:68vh;
    }
    h2{
        margin-left: 10%;
        margin-top: 1%;
    }
    .form-busqueda{
        margin-left:10%;
        margin-top:1%;
        margin-bottom:1%;
    }

    .form-busqueda button{
        margin-left:3%;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
    }

    .form-busqueda button:hover{
        filter:brightness(85%)
    }

    .sin-oferta {
        margin-left: 10%;
        margin-top: 1%;
        font-style: italic; 
        font-size: 1em; 
    }
    
</style>

<h2>Ofertas de Empleo</h2>

<main>
    <form class='form-busqueda' method="GET" action="BusquedaEmpleo.php">
        <input type="text" name="rol" placeholder="Título del empleo" value="<?php echo htmlspecialchars($_GET['rol'] ?? ''); ?>">
        <input type="text" name="ubicacion" placeholder="Ubicación" value="<?php echo htmlspecialchars($_GET['ubicacion'] ?? ''); ?>">
        <select name="tipo">
            <option value="">Seleccionar tipo</option>
            <option value="hibrido" <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'hibrido') echo 'selected'; ?>>Híbrido</option>
            <option value="presencial" <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'presencial') echo 'selected'; ?>>Presencial</option>
            <option value="virtual" <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'virtual') echo 'selected'; ?>>Virtual</option>
        </select>
        <input type="number" name="sueldo" placeholder="Salario mínimo" value="<?php echo htmlspecialchars($_GET['sueldo'] ?? ''); ?>">
        <input type="date" name="fecha" value="<?php echo htmlspecialchars($_GET['fecha'] ?? ''); ?>">
        <button type="submit">Buscar</button>
    </form>

    <?php if ($ofertas): ?>
        <section class="container">
            <div class="row">
                <?php foreach ($ofertas as $oferta): ?>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($oferta['titulo_oferta'] ?? 'Sin título'); ?></h5>
                                <p class="card-text">
                                    <strong>Empresa:</strong> <?php echo htmlspecialchars($oferta['nombre_empresa']); ?><br>
                                    <strong>Ubicación:</strong> <?php echo htmlspecialchars($oferta['ciudad']); ?><br>
                                    <strong>Tipo:</strong> <?php echo htmlspecialchars($oferta['tipo']); ?><br>
                                    <strong>Salario:</strong> $<?php echo number_format($oferta['sueldo'], 2, ',', '.'); ?><br>
                                    <strong>Fecha de publicación:</strong> <?php echo htmlspecialchars($oferta['fecha_publicacion']); ?>
                                </p>
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalOferta<?php echo $oferta['id']; ?>">Ver más</button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para cada oferta -->
                    <div class="modal fade" id="modalOferta<?php echo $oferta['id']; ?>" tabindex="-1" aria-labelledby="modalOfertaLabel<?php echo $oferta['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalOfertaLabel<?php echo $oferta['id']; ?>"><?php echo htmlspecialchars($oferta['titulo_oferta']); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6><strong>Descripción:</strong></h6>
                                    <p><?php echo nl2br(htmlspecialchars($oferta['descripcion_oferta'])); ?></p>

                                    <h6><strong>Tipo:</strong></h6>
                                    <p><?php echo htmlspecialchars($oferta['tipo']); ?></p>

                                    <h6><strong>Ubicación:</strong></h6>
                                    <p><?php echo htmlspecialchars($oferta['ciudad']); ?></p>

                                    <h6><strong>Salario:</strong></h6>
                                    <p>$<?php echo number_format($oferta['sueldo'], 2, ',', '.'); ?></p>

                                    <h6><strong>Fecha de publicación:</strong></h6>
                                    <p><?php echo htmlspecialchars($oferta['fecha_publicacion']); ?></p>
                                </div>
                                <div class="modal-footer">
                                    <!-- Aquí se agrega un formulario con AJAX -->
                                    <form id="postularForm<?php echo $oferta['id']; ?>" method="POST" onsubmit="return postularOferta(event, <?php echo $oferta['id']; ?>)">
                                        <input type="hidden" name="oferta_id" value="<?php echo $oferta['id']; ?>">
                                        <button type="submit" class="btn btn-primary">Aplicar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php else: ?>
        <p class='sin-oferta'>No se encontraron ofertas que coincidan con los criterios de búsqueda.</p>
    <?php endif; ?>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Ajax JS -->

<script>
    function postularOferta(event, ofertaId) {
    event.preventDefault(); // Evita que el formulario se envíe tradicionalmente

    const formData = new FormData(document.getElementById('postularForm' + ofertaId));

    // Usamos AJAX para enviar la solicitud sin recargar la página
    fetch('/WorkOnline/scriptControl/ofertasControl/aplicarPropuesta.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'error' && data.message === 'Ya has postulado a esta oferta.') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message
            });
        } else if (data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: data.message
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al procesar tu postulación.'
            });
        }
    })


}

</script>