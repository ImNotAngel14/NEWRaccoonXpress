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
            require "src/views/product_details.php";
        }

        public function GetProductsBySearch($search)
        {
            $productModel = new Product();
            $products = $productModel->getProductsBySearch($search);
            return $products;
        }
    }
?>