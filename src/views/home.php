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
    <div class="container d-flex justify-content-center">
        <!-- Content -->
        <div class="row justify-content-start align-items-center w-100 h-90 p-4">
            <!-- Mejor votados -->
            <div class="container" id="Rated">
                <h3 style="text-align: center;">Mejor votados</h3>
                <div class="row row-xs-cols-1 row-sm-cols-2 row-md-cols-3 row-cols-lg-4 g-4">
                    <!-- Productos -->
                    <?php
                        if($products)
                        {
                            foreach($products as $product)
                            {
                                $productId = $product['product_id'];
                                $productName = $product['product_name'];
                                if(isset($product['image_1']))
                                {
                                    $productImage = "data:image/png;base64," . base64_encode($product['image_1']);
                                }
                                else
                                {
                                    $productImage = '/NewRaccoonXpress/src/views/assets/switchLite.webp';
                                }
                                $productPrice = $product['price'];
                                $productQuotable = $product['quotable'];
                                $rating = $product['average_rating'];
                                $review_count = 1;
                            }
                            include __DIR__ . '/layouts/product_template.php';
                        }
                        
                    ?>
                </div>
            </div>
            <!-- Recomendados -->
            <div class="container" id="Rated">
                <h3 style="text-align: center;" class="mt-4">Recomendados</h3>
                <div class="row row-xs-cols-1 row-sm-cols-2 row-md-cols-3 row-cols-lg-4 g-4">
                    <!-- Productos -->
                </div>
            </div>
            <!--Populares-->
            <div class="container" id="Rated">
                <h3 style="text-align: center;" class="mt-4">Populares</h3>
                <div class="row row-xs-cols-1 row-sm-cols-2 row-md-cols-3 row-cols-lg-4 g-4">
                    <!-- Productos -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>