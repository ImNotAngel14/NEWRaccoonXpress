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
    <div class="container-fluid d-flex justify-content-around">
        <!-- Content -->
        <div class="row justify-content-center w-100 h-90 p-4">
            <div class="col-md-6">
                <div class="card mb-3 p-4">
                    <div class="row g-0">
                        <!-- Imagen -->
                        <div class="col-md-3 d-flex align-items-center">
                            <img src="/NewRaccoonXpress/src/views/assets/no-profile-user.png" class="img-fluid rounded-start p-4" alt="..." style="height: 12rem; width:12rem; object-fit: contain; image-rendering: pixelated;">
                        </div>
                        <div class="col-md-5 ">
                            <div class="card-body">
                                <!-- Titulo -->
                                <h5 class="card-title"><b>Producto</b></h5>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <div class="input-group mb-3">
                                <button class="btn my-outline-gray" type="button">-</button>
                                <input type="text" class="form-control my-outline-gray text-center" placeholder="" value="0">
                                <button class="btn my-outline-gray" type="button">+</button>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-center justify-content-center p-4">
                            <div class="d-flex align-items-center">
                                <h5>$0.00</h5>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-start">
                <div class="card text-center mb-3" style="width: 18rem;">
                    <div class="card-header">
                        Resumen de compra
                    </div>
                    <div class="card-body text-start">
                        <p class="card-text mb-5">Productos: $0.00</p>
                        <h5 class="card-title">Total: $0.00</h5>
                        <a href="#" class="btn w-100 my-primary">Procesar pago</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>