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
    <title>Search</title>
</head>
<body>
    <?php
    include __DIR__ . '/layouts/navbar.php';
    ?>
    <div class="container-fluid p-4">
        <div class="row mb-4 w-100 h-90">
            <!-- Content -->
            <div class="row "></div>
                <h4>Busqueda: "
                    <?php
                        if(isset($_GET["search"]))
                        {
                            echo $_GET["search"];
                        }
                    ?>"
                </h4>
            </div>
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-2 col-md-6 col-sm-12 p-4">
                        <div class="card p-4">
                            <form method="get" action="search.php">
                                <!-- Price filter -->
                                <h5>Filtro de precio</h5>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="min_price" placeholder="Mínimo" aria-label="Precio mínimo" min="0">
                                    <div class="invalid-feedback">Precio debe ser mayor a 0</div>
                                </div>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="max_price" placeholder="Máximo" aria-label="Precio máximo" min="0">
                                    <div class="invalid-feedback">Precio debe ser mayor a 0</div>
                                </div>
                                <!-- Products order by -->
                                <div class="mb-3">
                                    <select class="form-select" name="results_order">
                                        <option value="">Ordenar productos por...</option>
                                        <option value="1" class="opcion">Mejor calificados</option>
                                        <option value="2" class="opcion">Más vendidos</option>
                                        <option value="3" class="opcion">Menos vendidos</option>
                                        <option value="4" class="opcion">Precio más alto</option>
                                        <option value="5" class="opcion">Precio más bajo</option>
                                    </select>
                                </div>
                                <!-- FIlter control buttons -->
                                <div class="text-center mb-3">
                                    <button type="submit" class="btn mb-2 w-100 my-primary">Aplicar filtros</button>
                                    <button type="button" id="registerButton" class="btn mb-2 w-100 my-secondary">Limpiar filtros</button>
                                </div>
                            </form> 
                        </div>                 
                    </div>
                    <div class="col-lg-10 col-12 p-4">
                        <div class="container">
                            <?php
                                //if ($result->num_rows > 0) 
                                if(true)
                                {
                                    echo "<div class='row row-xs-cols-1 row-sm-cols-2 row-cols-lg-3 row-cols-xl-4 g-4'>";
                                    $productId = 1;
                                    $productName = 'Nintendo Lite Switch Lite 32GB Standard color turquesa 2017';
                                    $productImage = 'assets/switchLite.webp';
                                    $productPrice = 59.99;
                                    $review_count = 1;
                                    $rating = 3;
                                    include __DIR__ . '/layouts/product_template.php';
                                    include __DIR__ . '/layouts/product_template.php';
                                    include __DIR__ . '/layouts/product_template.php';
                                    include __DIR__ . '/layouts/product_template.php';
                                    include __DIR__ . '/layouts/product_template.php';
                                    include __DIR__ . '/layouts/product_template.php';
                                }
                                else
                                {
                                    echo "
                                    <div>
                                        <h3>No hay publicaciones que coincidan con tu búsqueda</h3>
                                        <ul>
                                            <li><strong>Revisa la ortografía</strong> de la palabra.</li>
                                            <li>Utiliza <strong>palabras más genéricas</strong> o menos palabras.</li>
                                            <li><a href='#'> Navega por las categorías</a> para encontrar un producto similar</li>
                                        </ul>
                                    </div>
                                    ";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>