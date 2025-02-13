<?php

// Asegurarse de que el usuario esté logueado
if (!isset($_SESSION['user'])) {
    header('Location: /WorkOnline/login.php');
    exit();
}

// Conectar a la base de datos
include '../../scriptControl/db/db.php';

// Obtener el ID del usuario desde la sesión
$usuario_id = $_SESSION['user']['id']; // Acceder al ID del usuario

// Consultar los datos del usuario
$query = "SELECT nombre_completo, email, pais, telefono, direccion, telefono_adicional FROM usuarios WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch();
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modificar perfil</h5>
            </div>
            <div class="modal-body">
                <!-- Formulario de Tailwind -->
                <form action="/WorkOnline/scriptControl/sessionControl/updateProfile.php" method="POST">
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold text-gray-900">Información del perfil</h2>
                            <p class="mt-1 text-sm text-gray-600">Esta información se mostrará públicamente, ten cuidado con lo que compartes.</p>
                            
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="nombre_completo" class="block text-sm font-medium text-gray-900">Nombre Completo</label>
                                    <div class="mt-2">
                                        <input type="text" name="nombre_completo" id="nombre_completo" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm" value="<?php echo htmlspecialchars($usuario['nombre_completo']); ?>">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium text-gray-900">Correo Electrónico</label>
                                    <div class="mt-2">
                                        <input type="email" name="email" id="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm" value="<?php echo htmlspecialchars($usuario['email']); ?>" disabled>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="pais" class="block text-sm font-medium text-gray-900">País</label>
                                    <div class="mt-2">
                                        <input type="text" name="pais" id="pais" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm" value="<?php echo htmlspecialchars($usuario['pais']); ?>">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="telefono" class="block text-sm font-medium text-gray-900">Teléfono</label>
                                    <div class="mt-2">
                                        <input type="text" name="telefono" id="telefono" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm" value="<?php echo htmlspecialchars($usuario['telefono']); ?>">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="direccion" class="block text-sm font-medium text-gray-900">Dirección</label>
                                    <div class="mt-2">
                                        <input type="text" name="direccion" id="direccion" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm" value="<?php echo htmlspecialchars($usuario['direccion']); ?>">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="telefono_adicional" class="block text-sm font-medium text-gray-900">Teléfono Adicional</label>
                                    <div class="mt-2">
                                        <input type="text" name="telefono_adicional" id="telefono_adicional" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm" value="<?php echo htmlspecialchars($usuario['telefono_adicional']); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <style>
                            .modal-content{
                                width: 150%;
                            }
                            textarea{
                                width:100%;
                                height:180px;
                            }
                            .modal-title{
                                font-size: 24px;
                                display:flex;
                                align-items: center;
                                justify-content: center;
                            }
                            input{
                                padding:20px;
                                width:100%;
                            }
                            .modal-footer button{
                                width:150px;
                                height:60px;
                            }
                            .btn-secondary{
                                background-color: red;
                            }
                            .btn-secondary:hover{
                                backdrop-filter: grayscale(30%);
                            }
                        </style>
                        <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
