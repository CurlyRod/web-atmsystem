<?php  
 session_start();   
 if(isset($_SESSION["user_id"]))
 {
     $database = new Database();
     $mysqli  = $database->getConnection();
            $checkIfExist =  "SELECT * FROM admin_useraccounts 
                                 WHERE id = {$_SESSION["user_id"]}"; 
     $result = $mysqli->query($checkIfExist); 
     $userInformation =   $result->fetch_assoc(); 

     
 }
 else {
    header("Location: ../index.php");
    exit(); 
}
?>