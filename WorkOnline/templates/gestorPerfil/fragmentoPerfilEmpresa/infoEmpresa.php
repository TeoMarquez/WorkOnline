<style>
    .modal-backdrop{
        z-index:1;
    }
    .modal-content{
        width: 100% !important;
    }
    .modal-body .btn-secondary{
        background-color:red;
    }
    .modal-body .btn-primary{
        background-color:green;
    }
    .modal-body .btn-secondary:hover{
        background-color:red;
        filter: brightness(0.65);
    }
    .modal-body .btn-primary:hover{
        background-color:green;
        filter: brightness(0.85);
    }
    
</style>
<main class="container-empresa">
    <section id="info-empresa">
        <h1>Perfil de Empresa</h1>
        <div class="empresa-detalles">
            <h2>Nombre de la Empresa: <span id="nombre-empresa"><?php echo htmlspecialchars($empresa['nombre_completo'] ?? 'No disponible'); ?></span></h2>
            <p><strong>CUIT:</strong> <?php echo htmlspecialchars($empresa['cuit'] ?? 'No disponible'); ?></p>
            <p><strong>País:</strong> <?php echo htmlspecialchars($empresa['pais'] ?? 'No disponible'); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($empresa['telefono'] ?? 'No disponible'); ?></p>
            <p><strong>Contacto:</strong> <?php echo htmlspecialchars($empresa['email'] ?? 'No disponible'); ?></p>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editarEmpresaModal">Editar Información</button>
        </div>
    </section>

<!-- Modal de Edición -->
<div class="modal fade" id="editarEmpresaModal" tabindex="-1" aria-labelledby="editarEmpresaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarEmpresaModalLabel">Editar Información de la Empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="/WorkOnline/scriptControl/sessionControl/updateEmpresaProfile.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre_completo" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" value="<?php echo htmlspecialchars($empresa['nombre_completo'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="cuit" class="form-label">CUIT</label>
                        <input type="text" class="form-control" id="cuit" name="cuit" value="<?php echo htmlspecialchars($empresa['cuit'] ?? ''); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="pais" class="form-label">País</label>
                        <input type="text" class="form-control" id="pais" name="pais" value="<?php echo htmlspecialchars($empresa['pais'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($empresa['telefono'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($empresa['email'] ?? ''); ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

