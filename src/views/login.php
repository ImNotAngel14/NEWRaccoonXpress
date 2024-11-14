<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include __DIR__ . '/layouts/general_header.php';
    ?>
    <title>Iniciar sesión</title>
</head>
<body class="container d-flex justify-content-center ">
    <div class="row justify-content-center align-items-center w-100" style="height: 100vh;">
        <div class="col-sm-12 col-md-6 col-lg-4 m-5 ">
            <div class="card">
                <div class="card-header text-center p-4 my-primary">
                    <h3>Iniciar sesión</h3>
                </div>
                <div class="card-body m-4">
                    <div id="auth_status_msg" class="p-3 mb-3 text-bg-danger rounded-3 d-none">Credenciales incorrectas.</div>
                    <form method="post" action="index.php?controller=user&action=login" class="needs-validation" novalidate>
                        <!-- Username input -->
                        <div class="form-outline mb-3">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required/>
                            <div class="invalid-feedback">Ingrese un nombre de usuario con mínimo 3 caracteres.</div>
                        </div>
                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <div class="input-group mb-3">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required/>
                                <button type="button" class="btn my-outline-gray" onclick="togglePassword()"><i class="bi bi-eye-slash" id="toggleIcon"></i></button>
                            </div>
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
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="persistent" id="persistent">
                            <label class="form-check-label" for="persistent">
                                Mantener mi sesión iniciada
                            </label>
                        </div>
                        <!-- Log In button -->
                        <div class="text-center mb-3">
                            <button type="submit" class="btn mb-2 w-100 my-primary">Acceder</button>
                            <button type="button" id="registerButton" class="btn mb-2 w-100 my-secondary">Registrarse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/NewRaccoonXpress/src/views/js/login.js"></script>
</body>

</html>