<?php       
    
    $is_invalid = false; 
    
    if($_SERVER["REQUEST_METHOD"] === "POST")   
    {   
        require_once("./controller/config.php");
        $database = new Database();
        $mysqli = $database->getConnection(); 
         
        $checkIfExist = sprintf("SELECT * FROM admin_useraccounts WHERE email = '%s'",
                                        $mysqli->real_escape_string($_POST["email"])); 

        $result = $mysqli->query($checkIfExist);

        $userAccount = $result->fetch_assoc();  
         
        if($userAccount) 
        {   
            if(password_verify($_POST["password"] , $userAccount["password"]))
            {   
                session_start();  
                session_regenerate_id();
                $_SESSION["user_id"] = $userAccount["id"];    
                header("Location: ./dashboard");
                exit;
            }
        } 
        $is_invalid = true;
    }

?>