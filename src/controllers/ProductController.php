<?php
    require_once "src/models/Product.php";

    class ProductController
    {
        private $productModel = null;

        public function GetAllProducts()
        {
            $productModel = new Product();
            $products = $productModel->getAllProducts();
            return $products;
        }

        public function Product_details()
        {
            
        }

        public function GetProductsBySearch($search)
        {
            $productModel = new Product();
            $products = $productModel->getProductsBySearch($search);
            return $products;
        }
    }
?>