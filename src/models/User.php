<?php
require_once '../config/Database.php';

class User {
    private $conn = null;
    private $user_id;
    private $email;
    private $username;
    private $user_password;
    private $user_role;
    private $first_name;
    private $last_name;
    private $gender;
    private $birth_date;
    private $visibility;
    private $active;
    private $last_login_date;
    private $profile_image;

    public function __construct($user_id = null, $email = null, $username = null, $user_password = null, $user_role = null, 
                                $first_name = null, $last_name = null, $gender = null, $birth_date = null, 
                                $visibility = null, $active = null, $last_login_date = null, $profile_image = null) 
    {
        $this->user_id = $user_id;
        $this->email = $email;
        $this->username = $username;
        $this->user_password = $user_password;
        $this->user_role = $user_role;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->gender = $gender;
        $this->birth_date = $birth_date;
        $this->visibility = $visibility;
        $this->active = $active;
        $this->last_login_date = $last_login_date;
        $this->profile_image = $profile_image;
    }

    public function registerUser(
        $email = null,
        $username = null,
        $user_password = null,
        $user_role = null,
        $first_name = null,
        $last_name = null,
        $gender = null,
        $birth_date = null
    )
    {
        // Validaciones
        // Validación contraseña
        // Validación email
        // Validación username
        $sql = "CALL `sp_register`(?,?,?,?,?,?,?,?);";
        try
        {
            $database = new Database();
            $this->conn = $database->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param(
                "sssissis",
                $email,
                $username,
                $user_password,
                $user_role,
                $first_name,
                $last_name,
                $gender,
                $birth_date
            );
            $stmt->execute();
        }
        catch(mysqli_sql_exception $e)
        {
            // Verificar si el error es debido a una clave única duplicada
            if ($e->getCode() === 1062) 
            {
                echo "Error: El correo electrónico ya existe en la base de datos.";
            } 
            else 
            {
                // Manejar otros errores si es necesario
                echo "Error al insertar el registro: " . $e->getMessage();
            }
            return false;
        }
        return true;
    }

    public function authUser($username, $password) 
    {
        // Verifica el login usando un procedimiento almacenado ficticio
        $sql = "CALL `sp_authLogin`(?, ?);";
        $database = new Database();
        $this->conn = $database->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $foundUser = $row['found_user'];
        return $foundUser;
    }
    // Getters
    public function getUserId() {
        return $this->user_id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getUserPassword() {
        return $this->user_password;
    }

    public function getUserRole() {
        return $this->user_role;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getBirthDate() {
        return $this->birth_date;
    }

    public function getVisibility() {
        return $this->visibility;
    }

    public function getActive() {
        return $this->active;
    }

    public function getLastLoginDate() {
        return $this->last_login_date;
    }

    public function getProfileImage() {
        return $this->profile_image;
    }

    // Setters
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setUserPassword($user_password) {
        $this->user_password = $user_password;
    }

    public function setUserRole($user_role) {
        $this->user_role = $user_role;
    }

    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function setBirthDate($birth_date) {
        $this->birth_date = $birth_date;
    }

    public function setVisibility($visibility) {
        $this->visibility = $visibility;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function setLastLoginDate($last_login_date) {
        $this->last_login_date = $last_login_date;
    }

    public function setProfileImage($profile_image) {
        $this->profile_image = $profile_image;
    }
}
?>