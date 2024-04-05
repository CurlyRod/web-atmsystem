<?php       
    
    $is_invalid = false; 
    
    if($_SERVER["REQUEST_METHOD"] === "POST")   
    {   
        require_once("./database/config.php");
        $database = new Database();
        $mysqli = $database->getConnection(); 
         
        $checkIfExist = sprintf("SELECT * FROM admin_userccounts WHERE email = '%s'",
                                        $mysqli->real_escape_string($_POST["email"])); 

        $result = $mysqli->query($checkIfExist);

        $userAccount = $result->fetch_assoc();  
         
        if($userAccount) 
        {   
            if(password_verify($_POST["password"] , $userAccount["password_hash"]))
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