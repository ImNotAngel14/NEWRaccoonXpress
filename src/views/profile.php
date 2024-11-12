<?php
     require '../../api/middleware.php';

    // Llama al middleware antes de cualquier contenido
    AuthMiddleware::handle();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include __DIR__ . '/layouts/general_header.php';
    ?>
    <title>Home</title>
</head>
<body>
    <?php
    include __DIR__ . '/layouts/navbar.php';
    ?>
    <div class="container-fluid d-flex justify-content-center">
        <!-- Content -->
        <div class="row justify-content-start align-items-center w-100 h-90 p-4">
            <div class="col-3 d-flex justify-content-center " >
                <div class="card flex-fill">
                    <div class="card-body p-5">
                        <h3 class="card-title text-center ">Username</h3>
                        <div class='position-absolute top-0 end-0 m-4'>
                            <button id='edit_user' class='btn my-secondary' type='submit' data-bs-toggle='modal' data-bs-target='#ModalUpdateAccount'>
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </div>
                        <img id="profile_image" class="img-fluid p-5 text-center " src="assets/no-profile-user.png" alt="">
                        <h5 class="card-subtitle mb-4 text-body-secondary text-center ">Vendedor</h5>
                        <p class="card-text text-start">Correo :</p>
                        <p class="card-text text-start">Nombre completo :</p>
                        <p class="card-text text-start">Fecha de nacimiento :</p>
                        <div class="d-flex justify-content-center">
                            <button id='id_delete_account' class='btn my-danger m-2' data-bs-toggle='modal' data-bs-target='#ModalDeleteAccount'>
                                Eliminar Perfil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">

            </div>
        </div>
    </div>
    <!-- Update Profile Modal -->
    <div class="modal fade" id="ModalUpdateAccount" tabindex="-1" aria-labelledby="ModalmodifieLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modificar perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card">
                    <div class="card-body m-4">
                        <form method="POST" class="needs-validation" novalidate>
                            <div class="form-outline mb-3">
                                <input type="text" class="form-control p-2" id="username" name="username" placeholder="Username" required/>
                                <div class="invalid-feedback">Ingrese un nombre de usuario con mínimo 3 caracteres</div>
                            </div>
                            <div class="form-outline mb-3">
                                <input type="email" class="form-control p-2" id="email" name="email" placeholder="Email" required/>
                                <div class="invalid-feedback">Ingrese una dirección de correo electrónico válida.</div>
                            </div>
                            <div class="input-group has-validation mb-3">
                                <input type="password" class="form-control p-2" id="password" name="password" placeholder="Password" required/>
                                <button type="button" class="btn my-outline-gray" onclick="togglePassword()"><i class="bi bi-eye-slash" id="toggleIcon"></i></button>
                                <div class="invalid-feedback">
                                    <p>La contraseña debe incluir:</p>
                                    <ul>
                                        <li id="req_length">Al menos 8 caracteres.</li>
                                        <li id="req_upper">Una letra mayúscula.</li>
                                        <li id="req_lower">Una letra minúscula.</li>
                                        <li id="req_number">Un número.</li>
                                        <li id="req_special">Un carácter especial.</li>
                                    </ul>
                                </div>
                            </div>                        
                            <div class="row">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <input type="text" class="form-control" name="first_name" placeholder="First name" aria-label="First name" required>
                                    <div class="invalid-feedback">Ingrese su nombre.</div>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last name" aria-label="Last name" required>
                                    <div class="invalid-feedback">Ingrese su apellido.</div>
                                </div>
                            </div>
                            <div class="form-outline mb-3">
                                <input type="date" class="form-control p-2" id="birth_date" name="birth_date" placeholder="Fecha de Nacimiento " required>
                                <div class="invalid-feedback">Debe seleccionar una fecha de nacimiento.</div>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" name="gender" required >
                                    <option value="">Género</option>
                                    <option value="0" class="opcion">Masculino</option>
                                    <option value="1" class="opcion">Femenino</option>
                                </select>
                                <div class="invalid-feedback">Seleccione su género.</div>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="visibility" id="visibility">
                                <label class="form-check-label" for="visibility">
                                    Perfil público
                                </label>
                            </div>
                            <div class="text-center mb-3">
                                <button type="submit" class="btn mb-2 w-100 my-primary" value="SaveChanges">Guardar cambios</button>
                                <button type="button" class="btn mb-2 w-100 my-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Profile Modal -->
    <div class="modal fade" id="ModalDeleteAccount" tabindex="-1" aria-labelledby="ModalDeleteAccountLbl" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Eliminar Cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>¿Seguro que quieres eliminar tu cuenta?</h5>
                    <br>
                    <div class=" text-end">
                        
                        <form method="POST" onsubmit="return deactivate_account();">
                            <button type="button" class="btn my-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn my-danger" id="id_btn_delete_user">Aceptar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/profile.js"></script>
</body>
</html>