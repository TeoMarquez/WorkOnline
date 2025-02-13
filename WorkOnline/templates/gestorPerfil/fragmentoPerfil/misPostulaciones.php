<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Panel de postulaciones -->
<style>
    .postulacion-card{
        margin-top:1%;
        margin-bottom:5%;
    }
    .modal-content h5{
        margin-top:5%;
        margin-bottom:3%;
    }
    .modal-content h4{
        margin-top:1%
    }
    #botonCerrar{
        background-color:blue;
    }
</style>
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h3>Mis Postulaciones</h3>
        </div>
        <div class="card-body">
            <?php if (empty($postulaciones)): ?>
                <p>No has aplicado a ninguna propuesta.</p>
            <?php else: ?>
                <?php foreach ($postulaciones as $postulacion): ?>
                    <div class="postulacion-card">
                        <h4><?php echo htmlspecialchars($postulacion['titulo_oferta']); ?></h4>
                        <p class="fecha">Fecha de Postulación: <strong><?php echo date('d/m/Y', strtotime($postulacion['fecha_postulacion'])); ?></strong></p>
                        <p class="estado <?php echo 'estado-' . strtolower($postulacion['estado']); ?>">Estado: <strong><?php echo ucfirst($postulacion['estado']); ?></strong></p>
                        <div class="acciones">
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalPostulacion<?php echo $postulacion['id']; ?>">Ver Detalles</button>
                            <button class="btn btn-danger" onclick="confirmarRetiro(<?php echo $postulacion['id']; ?>)">Retirar Postulación</button>
                        </div>
                    </div>

                    <!-- Modal de detalles de la postulación -->
                    <div class="modal fade" id="modalPostulacion<?php echo $postulacion['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalPostulacionLabel<?php echo $postulacion['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="modalPostulacionLabel<?php echo $postulacion['id']; ?>"><?php echo htmlspecialchars($postulacion['titulo_oferta']); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5><strong>Descripción:</strong></h5>
                                    <p><?php echo nl2br(htmlspecialchars($postulacion['descripcion_oferta'])); ?></p>

                                    <h6><strong>Estado:</strong> <?php echo ucfirst($postulacion['estado']); ?></h6>
                                    <h6><strong>Fecha de Postulación:</strong> <?php echo date('d/m/Y', strtotime($postulacion['fecha_postulacion'])); ?></h6>

                                    <h5><strong>Información de la Empresa:</strong></h5>
                                    <p><strong>Nombre de la Empresa:</strong> <?php echo htmlspecialchars($postulacion['empresa_nombre']); ?></p>
                                    <p><strong>Contacto:</strong> <?php echo htmlspecialchars($postulacion['contacto']); ?></p>
                                    <p><strong>Sede:</strong> <?php echo htmlspecialchars($postulacion['sede']); ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button id='botonCerrar' type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS (asegurarse de tener la versión correcta) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function confirmarRetiro(postulacionId) {
        Swal.fire({
            title: '¿Estás seguro de que deseas retirar tu postulación?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Aplicar',
            cancelButtonText: 'Retroceder'
        }).then((result) => {
            if (result.isConfirmed) {
                // Llamada AJAX al archivo de retiro de postulación
                retirarPostulacion(postulacionId);
            }
        });
    }

    function retirarPostulacion(postulacionId) {
        const formData = new FormData();
        formData.append('postulacion_id', postulacionId);

        // Usamos AJAX para enviar la solicitud sin recargar la página
        fetch('/WorkOnline/scriptControl/ofertasControl/retirarPropuesta.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Esperamos la respuesta como JSON
        .then(data => {
            // Verificamos el estado de la respuesta
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: data.message
                }).then(() => {
                    location.reload(); // Recargar la página para reflejar el cambio
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
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al procesar tu solicitud.'
            });
        });
    }
</script>
