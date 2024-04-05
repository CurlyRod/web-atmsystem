<?php    
    // this define method is use to absolute file path and target specific file. 
    // my reference : https://www.php.net/manual/en/function.define  
    // date: modify 03-20-24 author: Rod Mark day:2

       require_once('../config.php');
  
        class UserRegister  
        {   
            private $conn; 
            public function __construct()
            {
                $this->conn = new Database();       
            } 
            public function RegisterStudent($studentNumber, $firstName, $middleName, $lastName, $email, $section, $password_hash)
            {
                $mysqli = $this->conn->getConnection();  
                $InsertAccount = "INSERT INTO UserAccounts (student_number, first_name,     
                                                            middle_name, last_name, email,  
                                                            section, password_hash)  
                                  VALUES (?, ?, ?, ?, ?, ?, ?)";                                                            
                $stmt = $mysqli->stmt_init();  
                if(!$stmt->prepare($InsertAccount))  
                {    
                        die("SQL error: " . $mysqli->error);
                }   
                $stmt->bind_param("sssssss", $studentNumber, $firstName, $middleName, $lastName, $email, $section, $password_hash);          
                
                 if($stmt->execute()){
                     Header("Location: signup-message.php");
                  } 
                 else 
                 {
                   die("Database error: Connection failed.");
                }                            
             } 
        } 

    class DeleteUser 
    {
        private $conn; 
        public function __construct()
        {
            $this->conn = new Database();         
        } 
        public function DeleteStudent($studentNumber)
        {
            $mysqli = $this->conn->getConnection();   
            $DeleteStudent = "DELETE FROM UserAccounts WHERE student_number = ?"; 
            $stmt = $mysqli->stmt_init();  
            if(!$stmt->prepare($InsertAccount))  
            {    
                    die("SQL error: " . $mysqli->error);
            }  
            $stmt->bind_param("s", $studentNumber);
           
            if($stmt->execute()){
                $response = ["success" => 200, "message" => "User registered successfully"]; 
                echo json_encode($response);
             } 
             else {
                $response = ["success" => false, "message" => "Failed to register user"];
            }
            
            header("Content-Type: application/json");
            echo json_encode($response);
        } 
    }

?>