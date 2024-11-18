<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/config/Database.php";
/*
    `product_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador de producto',
    `product_name` VARCHAR(64) NOT NULL COMMENT 'Nombre del producto',
    `description` VARCHAR(160) NOT NULL COMMENT 'Descripción del producto',
    `quotable` TINYINT(1) NOT NULL COMMENT 'Bandera de producto cotizable',
    `price` DECIMAL(10,2) COMMENT 'Precio del producto',
    `quantity` INT NOT NULL COMMENT 'Cantidad del producto',
    `active` TINYINT(1) COMMENT 'Bandera de producto activado',
    `approved_by` INT COMMENT 'Identificador del usuario administrador quien aprovó el producto',
*/
class Product
{
    private $conn = null;
    private $product_id;
    private $product_name;
    private $description;
    private $quotable;
    private $price;
    private $quantity;
    private $active;
    private $approved_by;

    private $average_rating;

    // Constructor
    public function __construct
    (    
        $product_id = null, 
        $product_name = null, 
        $description = null, 
        $quotable = null, 
        $price = null, 
        $quantity = null, 
        $active = null, 
        $approved_by = null,
        $average_rating = null
    )
    {
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->description = $description;
        $this->quotable = $quotable;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->active = $active;
        $this->approved_by = $approved_by;
        $this->average_rating = $average_rating;
    }

    public function getAllProducts()
    {        
        $sql = "SELECT `product_id`, `product_name`, `description`, `quotable`, `price`, `price`, `quantity`, `active`, `approved_by`, `average_rating`, `image_1` FROM `product_overview`;";
        $database = new Database();
        try
        {
            $this->conn = $database->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->error) {
                return false;
            }
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                $products = [];
                // Itera sobre los resultados y guárdalos en un arreglos
                while ($row = $result->fetch_assoc()) 
                {
                    $products[] = $row;
                }
                return $products;
            }
        }
        catch(mysqli_sql_exception $e)
        {
            echo "Error al obtener los datos: " . $e->getMessage();
            error_log($e . "\r\n", 3, "../logs/error_logs.log");
        }
    }

    public function getProductsBySearch($search, $filterOrder = null)
    {
        $sql = "CALL `sp_product_search`(?, ?);";
        $database = new Database();
        $this->conn = $database->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $search, $filterOrder);
        $stmt->execute();
        if ($stmt->error) {
            return null;
        }
        $result = $stmt->get_result();
        if($result->num_rows > 0)
        {
            $products = [];

            // Itera sobre los resultados y guárdalos en un arreglo
            while ($row = $result->fetch_assoc()) 
            {
                $products[] = $row;
            }
            return $products;
        }
    }

    //Getters
    public function getProductId()
    {
        return $this->product_id;
    }

    public function getProductName()
    {
        return $this->product_name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getQuotable()
    {
        return $this->quotable;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getApprovedBy()
    {
        return $this->approved_by;
    }

    // Setters
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    public function setProductName($product_name)
    {
        $this->product_name = $product_name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setQuotable($quotable)
    {
        $this->quotable = $quotable;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function setApprovedBy($approved_by)
    {
        $this->approved_by = $approved_by;
    }
}