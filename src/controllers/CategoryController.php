<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/src/models/CategoryModel.php";
    class CategoryController
    {
        private $categoryModel = null;
        public function GetAll()
        {
            $categoryModel = new CategoryModel();
            return $categoryModel->getAllCategories();
        }
    }
?>