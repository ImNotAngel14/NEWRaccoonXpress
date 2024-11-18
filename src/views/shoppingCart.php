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
    <div class="container p-4">
        <!-- Content -->
        <div class="row justify-content-center w-100 h-90 p-4" >
            <div class="col-md-8" id="cart-items">
                <!-- Shopping Cart Item -->
                <?php
                    $subtotal = 0.0;
                    if($shoppingCartItems)
                    {
                        foreach($shoppingCartItems as $shoppingCartItem)
                        {
                            $shoppingCartProductId = $shoppingCartItem['product_id'];
                            $shoppingCartProductName = $shoppingCartItem['product_name'];
                            $shoppingCartPrice = $shoppingCartItem['price'];
                            $shoppingCartProductQuantity = $shoppingCartItem['product_quantity'];
                            $shoppingCartQuantity = $shoppingCartItem['cart_quantity'];
                            if(isset($shoppingCartItem['image_1']))
                            {
                                $shoppingCartProductImage = "data:image/png;base64," . base64_encode($shoppingCartItem['image_1']);
                            }
                            else
                            {
                                $shoppingCartProductImage = "/NewRaccoonXpress/src/views/assets/no-profile-user.png";
                            }
                            $subtotal += $shoppingCartPrice * $shoppingCartQuantity;
                            include __DIR__ . '/layouts/list_item_template.php';
                        }  
                    }
                ?>
            </div>
            <!-- Purchase form -->
            <div class="col-md-4 d-flex justify-content-center align-items-start">
                <form action="">
                    <div class="card text-center mb-3" style="width: 18rem;">
                        <div class="card-header">Resumen de compra</div>
                        <div class="card-body text-start">
                            <p class="card-text mb-5">Productos: $<?php echo htmlspecialchars((float)$subtotal)?></p>
                            <h5 class="card-title mb-2">Total: $<?php echo htmlspecialchars((float)$subtotal)?></h5>
                            <a href="#" class="btn w-100 my-primary">Procesar pago</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/NewRaccoonXpress/src/views/js/shoppingCart.js"></script>
</body>
</html>