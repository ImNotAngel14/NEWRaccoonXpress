<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include __DIR__ . '/layouts/general_header.php';
    ?>
    <title>Productos</title>
</head>
<body>
    <div class="container-fluid d-flex flex-column w-100 vh-100">    
        <div class="row">
            <?php
                include __DIR__ . '/layouts/navbar.php';
            ?>
        </div>
        <!-- Content -->
        <div class="row flex-grow-1 d-flex justify-content-center align-items-start">
            <div class="col-sm-12 col-md-8 col-lg-6 m-5 ">
                <div class="card p-3">
                    <h3>Administradores</h3>
                    <table class="table">
                    <tr>
                        <th>Correo</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Género</th>
                        <th>Cumpleaños</th>
                    </tr>
                    <tr>
                        <td>Alfreds Futterkiste</td>
                        <td>Maria Anders</td>
                        <td>Germany</td>
                        <td>Germany</td>
                        <td>Germany</td>
                        <td>Germany</td>
                        <td><button class="btn btn-secondary">Actualizar</button></td>
                        <td><button class="btn btn-danger">Eliminar</button></td>
                    </tr>
                </table>
                </div>
            </div>            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
