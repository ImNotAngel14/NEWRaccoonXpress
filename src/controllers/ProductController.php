<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/src/models/Product.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/src/controllers/CategoryController.php";

    class ProductController
    {
        private $productModel = null;

        public function AddProduct()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $user_id = $_SESSION['user'];
            $product_name = $_POST['product_name'];
            $description = $_POST['description'];
            $quotable = isset($_POST['quotable']);
            $price = isset($_POST['price']) ? (float)$_POST['price'] : 0.0;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
            $category_id = $_POST['category'];
            $imageData = NULL;
            $imageData2 = NULL;
            $imageData3 = NULL;
            $video = NULL;
            if(isset($_FILES['image_1']) && $_FILES['image_1']['error'] === UPLOAD_ERR_OK)
            {
                $fileTmpPath = $_FILES['image_1']['tmp_name'];
                $imageData = file_get_contents($fileTmpPath);
            }
            
            if(isset($_FILES['image_2']) && $_FILES['image_2']['error'] === UPLOAD_ERR_OK)
            {
                $fileTmpPath = $_FILES['image_2']['tmp_name'];
                $imageData2 = file_get_contents($fileTmpPath);
            }
            
            if(isset($_FILES['image_3']) && $_FILES['image_3']['error'] === UPLOAD_ERR_OK)
            {
                $fileTmpPath = $_FILES['image_3']['tmp_name'];
                $imageData3 = file_get_contents($fileTmpPath);
            }
            
            if(isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK)
            {
                $fileTmpPath = $_FILES['video']['tmp_name'];
                $video = file_get_contents($fileTmpPath);
            }
            $productModel = new Product();
            $success = false;

            
            $success = $productModel->createProduct($user_id, $product_name, $description, $quotable, $price, $quantity, $category_id, $imageData, $imageData2, $imageData3, $video);
            echo json_encode(['success' => $success]);
            exit;
            if($success)
            {
                //header("Location: index.php?controller=product&action=GetProductsByUser");
            }
            else
            {

            }
        }

        public function ShowAddProductView()
        {
            $categoryController = new CategoryController();
            $categories = $categoryController->GetAll();
            require "src/views/createProduct.php";
        }

        public function DeleteProduct()
        {

        }

        public function UpdateProduct()
        {

        }

        public function GetProductsByUser()
        {

        }

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
                    $productImage2 = isset($product['image_2']) ? "data:image/png;base64," . base64_encode($product['image_2']) : "";
                    $productImage3 = isset($product['image_3']) ? "data:image/png;base64," . base64_encode($product['image_3']) : "";
                    $productVideo = isset($product['video']) ? "data:video/webm;base64," . base64_encode($product['video']) : "";
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