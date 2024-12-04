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

        public function Create()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $user_id = $_SESSION['user'];
            $success = false;
            if(!isset($_POST['category_title']))
            {
                echo json_encode(['success' => $success, 'message' => "No ingreso el nombre de la categoria"]);
                exit;
            }
            $category_title = $_POST['category_title'];
            $categoryModel = new CategoryModel();
            $success = $categoryModel->createCategory($user_id, $category_title);
            echo json_encode(['success' => $success]);
            exit;
        }
    }
?>