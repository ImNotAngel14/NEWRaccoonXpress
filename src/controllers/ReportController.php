<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/config/Database.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/src/controllers/CategoryController.php";
    class ReportController
    {
        public function salesReport() {
            // Lógica para generar el reporte de ventas
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            
            if(isset($_POST['start_date']))
            {
                $startDate = ($_POST['start_date'] !== "") ? $_POST['start_date'] : null;
            }
            if(isset($_POST['end_date']))
            {
                $endDate = ($_POST['end_date'] !== "") ? $_POST['end_date'] : null;
            }
            
            if(isset($_POST['category']))
            {
                $form_category = ($_POST['category'] !== "") ? (int)$_POST['category'] : null;
            }
            
            $sql = "CALL `sp_sales_report`(?,?,?);";
            $database = new Database();
            $this->conn = $database->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssi", $startDate, $endDate, $form_category);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                $sales = [];
                while ($row = $result->fetch_assoc()) 
                {
                    $sales[] = $row;
                }
                
            }
            $sql = "CALL `sp_sales_report_grouped`(?,?,?);";
            $database = new Database();
            $this->conn = $database->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssi", $startDate, $endDate, $form_category);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                $sales_grouped = [];
                while ($row = $result->fetch_assoc()) 
                {
                    $sales_grouped[] = $row;
                }
            }
            $categoryController = new CategoryController();
            $categories = $categoryController->GetAll();
            require "src/views/sales_report.php";
        }
    
        public function userOrders() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $userId = $_SESSION['user'];
            if(isset($_POST['start_date']))
            {
                $startDate = ($_POST['start_date'] !== "") ? $_POST['start_date'] : null;
            }
            if(isset($_POST['end_date']))
            {
                $endDate = ($_POST['end_date'] !== "") ? $_POST['end_date'] : null;
            }
            if(isset($_POST['category']))
            {
                $form_category = ($_POST['category'] !== "") ? (int)$_POST['category'] : null;
            }
            
            $sql = "CALL `sp_get_user_purchases`(?,?,?,?);";
            $database = new Database();
            $this->conn = $database->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("issi", $userId, $startDate, $endDate, $form_category);
            $stmt->execute();
            /*
            if ($stmt->error) {
                echo json_encode(['success'=>false]);
                return;
            }
            */
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                $orders = [];
                while ($row = $result->fetch_assoc()) 
                {
                    $orders[] = $row;
                }
                
            }
            $categoryController = new CategoryController();
            $categories = $categoryController->GetAll();
            require "src/views/my_purchases.php";

        }
    }
?>