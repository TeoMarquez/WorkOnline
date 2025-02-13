<?php
// Conectar a la base de datos
require '../../scriptControl/db/db.php';


if (!isset($_SESSION['user']) && !isset($_SESSION['empresa'])) {
    // Si no está logueado, mostrar un mensaje de error y evitar la carga de la página de postulaciones
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Debes iniciar sesión para postularte.',
            }).then(() => {
                window.location.href = '../gestorSesion/Inicio_Sesion.php'; // Redirigir a la página de login si no está logueado
            });
          </script>";
    exit();
}

// Consultar las propuestas laborales
$query = "
    SELECT o.id, o.titulo_oferta AS titulo, o.carga_horaria AS horas, o.sueldo AS pago, o.descripcion_oferta AS descripcion, e.nombre_completo AS empresa_nombre, s.ciudad AS sede, e.telefono AS contacto
    FROM ofertas_empleo o
    JOIN empresas e ON o.empresa_id = e.id
    JOIN sedes s ON e.id = s.empresa_id
    ORDER BY o.fecha_publicacion DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$propuestas = $stmt->fetchAll();
?>

<style>
    h3 {
        padding: 20px;
        font-size: 2rem; 
        font-weight: bold;
    }

   
    .container {
        height: 75.8vh;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .modal-content {
        padding: 20px;
    }

    /* Estilo para el modal */
    .modal-content {
        border-radius: 10px; 
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        background-color: #f8f9fa; 
        border-bottom: 2px solid #dee2e6; 
    }

    .modal-title {
        font-size: 1.5rem; 
        font-weight: bold; 
        color: #343a40;
    }

    .btn-close {
        color:rgb(214, 22, 22); 
        font-size: 1.5rem; 
    }

    .modal-body {
        font-size: 1rem; 
        line-height: 1.6; 
        color: #495057; 
    }

    .modal-body h6 {
        font-size: 1.2rem; 
        font-weight: bold; 
        color: #007bff;
    }

    .modal-footer {
        display: flex;
        justify-content: space-between; 
        padding: 15px 20px;
        background-color: #f8f9fa; 
        border-top: 2px solid #dee2e6; 
    }

    .modal-footer .btn {
        font-size: 1rem; 
        padding: 10px 20px; 
        border-radius: 5px; 
    }

    .modal-footer .btn-secondary {
        background-color:rgb(244, 2, 2); 
        border: none; 
    }

    .modal-footer .btn-primary {
        background-color:rgb(59, 190, 63); 
        border: none; 
    }

    .modal-footer .btn:hover {
        opacity: 0.7; 
    }

    .modal-body p {
        margin-bottom: 15px; 
    }

</style>
<div class="container">
    <h3 class="text-center mb-5">Novedades de Propuestas Laborales</h3>

    <div class="row">
        <?php foreach ($propuestas as $propuesta): ?>
            <!-- Card para cada propuesta laboral -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($propuesta['titulo']); ?></h5>
                        <p class="card-text">
                            <strong>Horas:</strong> <?php echo htmlspecialchars($propuesta['horas']); ?><br>
                            <strong>Pago:</strong> $<?php echo number_format($propuesta['pago'], 2, ',', '.'); ?>
                        </p>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalPropuesta<?php echo $propuesta['id']; ?>">Ver más</button>
                    </div>
                </div>
    </div>

            <!-- Modal de la Propuesta Completa -->
    <div class="modal fade" id="modalPropuesta<?php echo $propuesta['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalPropuestaLabel<?php echo $propuesta['id']; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPropuestaLabel<?php echo $propuesta['id']; ?>"><?php echo htmlspecialchars($propuesta['titulo']); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6><strong>Descripción:</strong></h6>
                            <p><?php echo nl2br(htmlspecialchars($propuesta['descripcion'])); ?></p>

                            <h6><strong>Detalles:</strong></h6>
                            <p><strong>Horas:</strong> <?php echo htmlspecialchars($propuesta['horas']); ?></p>
                            <p><strong>Pago:</strong> $<?php echo number_format($propuesta['pago'], 2, ',', '.'); ?></p>

                            <h6><strong>Información de la Empresa:</strong></h6>
                            <p><strong>Nombre de la Empresa:</strong> <?php echo htmlspecialchars($propuesta['empresa_nombre']); ?></p>
                            <p><strong>Sede:</strong> <?php echo htmlspecialchars($propuesta['sede']); ?></p>
                            <p><strong>Contacto:</strong> <?php echo htmlspecialchars($propuesta['contacto']); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <form id="postularForm<?php echo $propuesta['id']; ?>" method="POST" onsubmit="return postularOferta(event, <?php echo $propuesta['id']; ?>)">
                                    <input type="hidden" name="oferta_id" value="<?php echo $propuesta['id']; ?>">
                                    <button type="submit" class="btn btn-primary">Aplicar</button>
                            </form>                  
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Bootstrap JS (asegurarse de tener la versión correcta) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<script>
   
   function postularOferta(event, ofertaId) {
    event.preventDefault(); // Evita que el formulario se envíe tradicionalmente

    const formData = new FormData(document.getElementById('postularForm' + ofertaId));

    // Usamos AJAX para enviar la solicitud sin recargar la página
    fetch('/WorkOnline/scriptControl/ofertasControl/aplicarPropuesta.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data && data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: data.message
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al procesar tu postulación.'
        });
    });
}


</script>