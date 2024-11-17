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
                <h4>Busqueda: "<?php echo htmlspecialchars($search);?>"</h4>
            </div>
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-2 col-md-6 col-sm-12 p-4">
                        <div class="card p-4">
                            <form method="get" action="index.php?controller=search&action=search">
                                <!-- Price filter -->
                                <h5>Filtro de precio</h5>
                                <!--div class="mb-3">
                                    <input type="number" class="form-control" name="min_price" placeholder="Mínimo" aria-label="Precio mínimo" min="0">
                                    <div class="invalid-feedback">Precio debe ser mayor a 0</div>
                                </div>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="max_price" placeholder="Máximo" aria-label="Precio máximo" min="0">
                                    <div class="invalid-feedback">Precio debe ser mayor a 0</div>
                                </div-->
                                <!-- Products order by -->

                                <input type="hidden" name="controller" value="search">
                                <input type="hidden" name="action" value="search">
                                <input type="hidden" name="search" value="<?php echo htmlspecialchars($search);?>">
                                <div class="mb-3">
                                    <select class="form-select" name="filter_order">
                                        <option value="">Ordenar productos por...</option>
                                        <option value="1" class="opcion" <?php if((int)$filterOrder == 1){  echo " selected"; } ?> >Mejor calificados</option>
                                        <option value="2" class="opcion" <?php if((int)$filterOrder == 2){  echo " selected"; } ?>>Precio más alto</option>
                                        <option value="3" class="opcion" <?php if((int)$filterOrder == 3){  echo " selected"; } ?>>Precio más bajo</option>
                                        <option value="4" class="opcion" <?php if((int)$filterOrder == 4){  echo " selected"; } ?>>Más vendidos</option>
                                        <option value="5" class="opcion" <?php if((int)$filterOrder == 5){  echo " selected"; } ?>>Menos vendidos</option>
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
                                if($products)
                                {
                                    foreach($products as $product)
                                    {
                                        echo "<div class='row row-xs-cols-1 row-sm-cols-2 row-cols-lg-3 row-cols-xl-4 g-4'>";
                                        $productId = $product['product_id'];
                                        $productName = $product['product_name'];
                                        $productImage = isset($product['image_1']) ? "data:image/png;base64," . base64_encode($product['image_1']) : '/NewRaccoonXpress/src/views/assets/switchLite.webp';
                                        $productPrice = $product['price'];
                                        $productQuotable = $product['quotable'];
                                        $rating = $product['average_rating'];
                                        $review_count = 1;
                                    }
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