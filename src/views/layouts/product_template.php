<div class='col d-inline-flex justify-content-center'>
    <div class='card' style='width: 18rem;'>
        <a href='index.php?controller=product&action=productDetails&product=<?php echo htmlspecialchars($productId); ?>' style='color: black; text-decoration: none;'>
            <!-- Image -->
            <img src='<?php echo htmlspecialchars($productImage);?>' class='card-img-top' alt='' style='height: 18rem; object-fit: contain; image-rendering: pixelated;'>

            <div class='card-body'>
                <!-- Name -->
                <p class='card-text'><?php  echo htmlspecialchars($productName); ?></p>
                <!-- Price -->
                <h5 class='card-title'>$<?php  echo htmlspecialchars($productPrice); ?></h5>
                <div class='rate-container'>
                    <!-- Rating -->
                    <?php
                        if($rating > 0)
                        {
                            for($i = 0; $i < 5; $i++)
                            {
                                # if($i < $rating)
                                if($i < $rating)
                                {
                                    echo "<i class='bi bi-star-fill'></i>";
                                }
                                else
                                {
                                    echo "<i class='bi bi-star'></i>";
                                }
                            }
                            // echo "<p class='card-text'><small class='text-body-secondary'>(" . $review_count . ")</small></p>";
                        }
                        else
                        {
                            echo "<p class='card-text'><small class='text-body-secondary'>No hay suficientes reseñas</small></p>";
                        }    
                    ?>
                </div>
                <br>
            </div>
        </a>
    </div>
</div>