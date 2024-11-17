<?php
    require_once "ProductController.php";
    //require_once "../models/Product.php";
    // require_once "../models/User.php";

    enum filterOrder: int
    {
        case bestRated = 1; // 0
        case bestSeller = 2; // 1
        case lessSeller = 3; // 2
    }

    class SearchController
    {
        private $productModel;
        private $userModel;
        private $listModel; // opcional
        public function Search()
        {
            // obtener parametro de busqueda
            if(isset($_GET['search']))
            {
                $search = $_GET['search'];
                $filterOrder = isset($_GET['filter_order']) ? $_GET['filter_order'] : null;
                // obtenemos los filtros
                // UserController::ApplyFilters( 0, 0, 0);
                // creamos los modelos
                $productController = new ProductController();
                
                // $userModel = new User();
                // llamamos al metodo de busqueda de productos
                $products = $productController->GetProductsBySearch($search, $filterOrder); // productos que coincidan con los filtros
                //$products = $productController->GetAllProducts();
                // obtener resultados de busqueda para productos
                // obtener resultados de busqueda para usuarios
            }
            // imprimir los resultados
            require "src/views/search.php";
        }

        private function ApplyFilters($minPrice, $maxPrice, $filterOrder)
        {

        }
    }
?>