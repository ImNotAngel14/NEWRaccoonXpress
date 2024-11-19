<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include __DIR__ . '/layouts/general_header.php';
    ?>
    <title>Detalles</title>
</head>
<body>
    <?php
    include __DIR__ . '/layouts/navbar.php';
    ?>
    <!-- Content -->
    <div class="container w-100 h-90">
        
        <!-- Product -->
        <div class="row p-4">
            <!-- Images -->
            <div class="col-md-3 align-self-center">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col m-4 d-flex align-items-center justify-content-center" style="width: 12rem; height: 12rem; background-color: white;">
                            <img src="<?php echo htmlspecialchars($productImage2) ?>" alt="" class="img-fluid container-fluid p-4" style='object-fit: contain; image-rendering: pixelated;'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m-4 d-flex align-items-center justify-content-center" style="width: 12rem; height: 12rem; background-color: white;">
                            <img src="<?php echo htmlspecialchars($productImage3) ?>" alt="" class="img-fluid container-fluid p-4" style='object-fit: contain; image-rendering: pixelated;'>
                        </div>                    
                    </div>
                    <div class="row">
                        <div class="col m-4 d-flex align-items-center justify-content-center" style="width: 12rem; height: 12rem; background-color: white;">
                            <img src="<?php echo htmlspecialchars($productImage1) ?>" alt="" class="img-fluid container-fluid p-4" style='object-fit: contain; image-rendering: pixelated;'>
                        </div>                    
                    </div>
                </div>
            </div>
            <!-- Main file -->
            
            <div class="col-md-6 d-flex align-self-center align-items-center justify-content-center" style="width: 30rem; height: 30rem; background-color: white;">
                <video controls>
                    <source src="<?php echo htmlspecialchars($productVideo) ?>" type="video/webm">
                    Tu navegador no soporta la reproducción de videos.
                </video>    
            </div>
            <!-- Product information -->
            <div class="col-md-3 d-flex align-self-center m-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Name -->
                        <h5 class="card-title mb-3"><?php echo htmlspecialchars($productName) ?></h5>
                        <!-- Rating -->
                        <div class='rate-container mb-3'>
                            <?php
                                if($productUnitsSold > 0)
                                {
                                    for($i = 0; $i < 5; $i++)
                                    {
                                        # if($i < $rating)
                                        if($i < $productRating)
                                        {
                                            echo "<i class='bi bi-star-fill'></i>";
                                        }
                                        else
                                        {
                                            echo "<i class='bi bi-star'></i>";
                                        }
                                    }
                                    echo "<p class='card-text'><small class='text-body-secondary'>(" . $productUnitsSold . ")</small></p>";
                                }
                                else
                                {
                                    echo "<p class='card-text'><small class='text-body-secondary'>No hay suficientes reseñas</small></p>";
                                }    
                            ?>
                        </div>
                        <!-- Description -->
                        <p class="card-text mb-3"><small class="text-body-secondary">Descripcion</small></p>
                        <p class="card-text mb-5"><small class="text-body-secondary"><?php echo htmlspecialchars($productDescriotion) ?></small></p>
                        <!-- Price -->
                        <h1 class="card-title mb-3">$<?php echo htmlspecialchars($productPrice) ?></h1>
                        <!-- Cantidad -->
                        <form action="index.php?controller=shoppingCart&action=addproduct" method="POST">
                            <div class="input-group">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($productId) ?>">
                                <label for="quantity">Cantidad que desea agregar al carrito:</label>
                                <input type="number" id="quantity" name="quantity" class="form-control my-outline-gray text-center" placeholder="" max="<?php  echo htmlspecialchars((int)$productQuantity); ?>" value="1">
                            </div>
                            <p class="card-text mb-3"><small class="text-body-secondary"><?php echo htmlspecialchars($productQuantity) ?> disponibles</small></p>
                            <button type="submit" class="btn my-primary w-100 mb-3" data-product-id="<?php echo htmlspecialchars($productId) ?>">Agregar al carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Review section -->
        <div class="row text-center">
            <h4>Reseñas</h4>
        </div>
        <div class="row p-4">
            <div class="card p-2">
                <div class="row">
                    <div class="col-md-2 text-center p-4">
                        <img src="/NewRaccoonXpress/src/views/assets/no-profile-user.png" class="img-fluid rounded-start" alt="..." style='height:6rem; width:6rem; border-radius: 50%; image-rendering: pixelated;'>
                        <p>Username</p>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Review Title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <div class='rate-container mb-3'>
                                    <i class='bi bi-star-fill'></i>
                                    <i class='bi bi-star-fill'></i>
                                    <i class='bi bi-star-fill'></i>
                                    <i class='bi bi-star-fill'></i>
                                    <i class='bi bi-star'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>