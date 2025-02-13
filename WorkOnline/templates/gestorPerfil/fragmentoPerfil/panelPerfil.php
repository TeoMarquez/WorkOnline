<style>
    .panel-usuario{
        display: flex;
        margin-left:20%;
        width: 80%;
        background-color:#f3f3f3;
    }
    .panel-usuario h1{
        margin-bottom:15px
    }
</style>
<section class="panel-usuario">
        <div class="info-perfil">
            <h1>Bienvenido, <?php echo htmlspecialchars($usuario['nombre_completo']); ?></h1>
            
            <p>Email: <span id="email"><?php echo htmlspecialchars($usuario['email']); ?></span></p>
            <p>Ubicación: <span id="ubicacion"><?php echo htmlspecialchars($usuario['pais']); ?></span></p>
            
            <!-- Mostrar información adicional -->
            <p>Teléfono: <span id="telefono"><?php echo htmlspecialchars($usuario['telefono_adicional']); ?></span></p>
            <p>Dirección: <span id="direccion"><?php echo htmlspecialchars($usuario['direccion']); ?></span></p>
            
            <?php  
            if (empty($usuario['direccion']) || empty($usuario['telefono_adicional'])) {
                echo '<div class="blankslate">
                            <div class="blankslate-body">
                                <h4>Parece que no terminaste tu perfil!</h4>
                                <p>
                                Termina de configurar tu cuenta!
                                </p>
                            </div>
                            <div class="blankslate-actions">
                                <!-- Botón para abrir el modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Modificar perfil
                                </button>
                            </div>
                        </div>';
            } else {
                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Modificar perfil
                </button>';
            }
            ?>
        </div>
</section>
    <div class="container">
        <div class="row">
            <!-- Panel de trabajos -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Mis Trabajos</h3>
                    </div>
                    <div class="card-body">
                        <!-- Aquí va el contenido de los trabajos -->
                    </div>
                </div>
            </div>
        
            <?php include 'misPostulaciones.php'; ?>

        </div>
    </div>