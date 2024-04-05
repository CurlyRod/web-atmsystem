<?php   
    if(isset($_POST['action']) && $_POST['action'] == "logout")
    {   
        session_start(); 
        session_unset();
        session_destroy(); 
        $result = ["status" => 200 , "isLogout" => true]; 
        echo json_encode($result);  
    }  
?>