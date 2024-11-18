<!--$_COOKIE
$shoppingCartId = $shoppingCartItem['shoppingCart_id'];
$shoppingCartProductName = $shoppingCartItem['product_name'];
$shoppingCartPrice = $shoppingCartItem['price'];
$shoppingCartProductQuantity = $shoppingCartItem['product_quantity'];
$shoppingCartQuantity = $shoppingCartItem['cart_quantity'];

-->

<div class="col-md-6">
    <div class="card mb-3 p-4">
        <div class="row g-0">
            <!-- Imagen -->
            <div class="col-md-3 d-flex align-items-center">
                <img src="<?php  echo htmlspecialchars($shoppingCartProductImage); ?>" class="img-fluid rounded-start p-4" alt="..." style="height: 12rem; width:12rem; object-fit: contain; image-rendering: pixelated;">
            </div>
            <div class="col-md-5 ">
                <div class="card-body">
                    <!-- Titulo -->
                    <h5 class="card-title"><b><?php  echo htmlspecialchars($shoppingCartProductName); ?></b></h5>
                </div>
            </div>
            <!-- Cantidad en el carrito de compras -->
            <div class="col-md-2 d-flex align-items-center">
                <div class="input-group">
                    <button class="btn my-outline-gray" type="button">-</button>
                    <input type="text" class="form-control my-outline-gray text-center" placeholder="" max="<?php  echo htmlspecialchars((int)$shoppingCartProductQuantity); ?>" value="<?php  echo htmlspecialchars($shoppingCartQuantity); ?>">
                    <button class="btn my-outline-gray" type="button">+</button>
                </div>
            </div>
            <!-- Subtotal -->
            <div class="col-md-2 d-flex align-items-center justify-content-center p-4">
                <div class="d-flex align-items-center">
                    <h5>$<?php  echo htmlspecialchars((float)$shoppingCartPrice * (int)$shoppingCartQuantity); ?></h5>
                </div>
            </div>
        </div>
    </div>
    
</div>