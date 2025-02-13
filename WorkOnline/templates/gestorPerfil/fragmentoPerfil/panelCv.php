<?php
// Asegurarse de que el usuario esté logueado
if (!isset($_SESSION['user'])) {
    header('Location: /WorkOnline/login.php');
    exit();
}

// Conectar a la base de datos
include '../../scriptControl/db/db.php';

// Obtener el ID del usuario desde la sesión
$usuario_id = $_SESSION['user']['id'];

// Consultar los datos del CV del usuario
$query = "SELECT * FROM curriculums WHERE usuario_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$usuario_id]);
$cv = $stmt->fetch();
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<div class="container">
    <?php if (!$cv): ?>
        <!-- Si no hay CV, mostrar el mensaje -->
        <div class="blankslate">
            <div class="blankslate-body">
                <h4>Parece que no terminaste tu perfil!</h4>
                <p>Termina de configurar tu cuenta!</p>
            </div>
            <div class="blankslate-actions">
                <!-- Botón para abrir el modal de modificar perfil -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropCv">
                    Modificar perfil
                </button>
            </div>
        </div>
    <?php else: ?>
        <!-- Si ya hay un CV, mostrar el panel con los datos -->
        <div class="panel-cv">
            <h3>Tu CV</h3>
            <div class="cv-content">
                <div class="mb-3">
                    <label for="titulo_cv" class="form-label">Título del CV</label>
                    <textarea id="titulo_cv" class="form-control" rows="2" readonly><?php echo htmlspecialchars($cv['titulo_cv']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea id="descripcion" class="form-control" rows="4" readonly><?php echo htmlspecialchars($cv['descripcion']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="experiencia_laboral" class="form-label">Experiencia Laboral</label>
                    <textarea id="experiencia_laboral" class="form-control" rows="6" readonly><?php echo implode("\n", json_decode($cv['experiencia_laboral'], true)); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="habilidades" class="form-label">Habilidades</label>
                    <textarea id="habilidades" class="form-control" rows="4" readonly><?php echo implode("\n", json_decode($cv['habilidades'], true)); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="educacion" class="form-label">Educación</label>
                    <textarea id="educacion" class="form-control" rows="4" readonly><?php echo implode("\n", json_decode($cv['educacion'], true)); ?></textarea>
                </div>
            </div>
            <!-- Botón para abrir el modal de modificación -->
            <style>
    
                .panel-cv button{
                    margin-bottom:20px;
                }
            </style>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropCv">
                Modificar CV
            </button>
        </div>
    <?php endif; ?>
</div>



<!-- Modal -->
<div class="modal fade" id="staticBackdropCv" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modificar CV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para modificar el CV -->
                <form action="/WorkOnline/scriptControl/cvControl/updateCV.php" method="POST">
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold text-gray-900">Información del CV</h2>
                            <p class="mt-1 text-sm text-gray-600">Esta información se mostrará públicamente, ten cuidado con lo que compartes.</p>
                            
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="titulo_cv" class="block text-sm font-medium text-gray-900">Título del CV</label>
                                    <div class="mt-2">
                                        <input type="text" name="titulo_cv" id="titulo_cv" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm" value="<?php echo htmlspecialchars($cv['titulo_cv'] ?? ''); ?>" placeholder="Ingrese el título del CV">
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="descripcion" class="block text-sm font-medium text-gray-900">Descripción</label>
                                    <div class="mt-2">
                                        <textarea name="descripcion" id="descripcion" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm" placeholder="Ingrese una descripción"><?php echo htmlspecialchars($cv['descripcion'] ?? ''); ?></textarea>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="experiencia_laboral" class="block text-sm font-medium text-gray-900">Experiencia Laboral</label>
                                    <div class="mt-2">
                                        <textarea name="experiencia_laboral" id="experiencia_laboral" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm" placeholder="Ingrese tu experiencia laboral"><?php echo @implode("\n", is_array(json_decode($cv['experiencia_laboral'], true)) ? json_decode($cv['experiencia_laboral'], true) : []); ?></textarea>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="habilidades" class="block text-sm font-medium text-gray-900">Habilidades</label>
                                    <div class="mt-2">
                                        <textarea name="habilidades" id="habilidades" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm" placeholder="Ingrese tus habilidades"><?php echo @implode("\n", is_array(json_decode($cv['habilidades'], true)) ? json_decode($cv['habilidades'], true) : []); ?></textarea>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="educacion" class="block text-sm font-medium text-gray-900">Educación</label>
                                    <div class="mt-2">
                                        <textarea name="educacion" id="educacion" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm" placeholder="Ingrese tu formación académica"><?php echo @implode("\n", is_array(json_decode($cv['educacion'], true)) ? json_decode($cv['educacion'], true) : []); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
