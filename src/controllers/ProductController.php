<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/src/models/Product.php";

    class ProductController
    {
        private $productModel = null;

        public function GetAllProducts()
        {
            $productModel = new Product();
            $products = $productModel->getAllProducts();
            return $products;
        }

        public function ProductDetails()
        {
            // cargar informacion del producto
            if(isset($_GET['product']))
            {
                $productId = $_GET['product'];
                $productModel = new Product();
                $product = $productModel->getProduct((int)$productId);
                if($product)
                {
                    $productId = $product['product_id'];
                    $productName = $product['product_name'];
                    $productDescriotion = $product['description'];
                    $productQuotable = $product['quotable'];
                    $productPrice = $product['price'];
                    $productQuantity = $product['quantity'];
                    $productActive = $product['active'];
                    $productApprovedBy = $product['approved_by'];
                    $productRating = $product['average_rating'];
                    $productUnitsSold = $product['units_sold'];
                    $productImage1 = isset($product['image_1']) ? "data:image/png;base64," . base64_encode($product['image_1']) : "";
                    //$productImage2 = isset($product['image_2']) ? "data:image/png;base64," . base64_encode($product['image_2']) : "";
                    //$productImage3 = isset($product['image_3']) ? "data:image/png;base64," . base64_encode($product['image_3']) : "";
                    //$productVideo = isset($product['video']) ? "data:image/png;base64," . base64_encode($product['video']) : "";
                }
                // cargar las reseñas
                require "src/views/product_details.php";
            }
            else
            {
                echo "No se encontraron los datos del producto";
            }
            
        }

        public function GetProductsBySearch($search)
        {
            $productModel = new Product();
            $products = $productModel->getProductsBySearch($search);
            return $products;
        }
    }
?>