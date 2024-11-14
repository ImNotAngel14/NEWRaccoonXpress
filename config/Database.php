<?php
   class Database {
      private $host = "localhost";  // Host de la base de datos
      private $db_name = "new_raccoonxpress";  // Nombre de la base de datos
      private $username = "root";  // Usuario de MySQL
      private $password = "";  // Contraseña de MySQL
      private $conn;

      // Método para establecer la conexión a la base de datos
      public function connect() {
         $this->conn = null;         
         try 
         {
            $mysqli = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($mysqli->connect_errno) 
            {
               $response = (object)array("status"=>500, "message"=>$mysqli->connect_error);
               echo json_encode($response);
               die("Error de conexión: " . $mysqli->connect_error);
            }
         } catch(Exception $e) 
         {
            $response = (object)array("status"=>500,"message"=>"Error a conectarse a la base de datos, favor de crear la base de datos en el archivo database.sql o configurar el usuario y contraseña en el archivo db.php");
            echo json_encode($response);
            exit;
         }
         return $mysqli;
      }
   }

?>