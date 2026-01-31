<?php
class Auth{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function login($email, $password){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows === 1){
            $user = $result->fetch_assoc();

            if(password_verify($password, $user['password'])){
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role']; 

                return true;
            }
        }
        return false; 
    }
}
?>