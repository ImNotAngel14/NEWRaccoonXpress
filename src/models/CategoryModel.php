<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/config/Database.php";

    class CategoryModel
    {
        private $category_id;
        private $title;
        private $description;
        private $creation_date;
        private $created_by;
        private $active;

        public function __construct
        (
            $category_id = null,
            $title = null,
            $description = null,
            $creation_date = null,
            $created_by = null,
            $active = null
        )
        {
            $this->category_id = $category_id;
            $this->title = $title;
            $this->description = $description;
            $this->creation_date = $creation_date;
            $this->created_by = $created_by;
            $this->active = $active;
        }

        public function getAllCategories()
        {
            $sql = "SELECT * FROM `categories`;";
            $database = new Database();
            $this->conn = $database->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->error) {
                return null;
            }
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                $categories = [];
                while ($row = $result->fetch_assoc()) 
                {
                    $categories[] = $row;
                }
                return $categories;
            }
        }

        public function createCategory($created_by, $title)
        {
            //INSERT INTO `categories`(`category_id`, `title`, `description`, `creation_date`, `created_by`, `active`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')
            $sql = "INSERT INTO `categories`(`title`, `created_by`) VALUES (?,?);";
            $database = new Database();
            try{
                $this->conn = $database->connect();
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param(
                    "si",
                    $title,
                    $created_by
                );
                $stmt->execute();
                if ($stmt->error) {
                    return false;
                }
                return true;
            }
            catch(mysqli_sql_exception $e)
            {
                error_log($e . "\r\n", 3, $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/logs/error_logs.log");
                return false;
            }
        }
    }
?>