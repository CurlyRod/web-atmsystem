<?php  
 session_start();   
 if(isset($_SESSION["user_id"]))
 {
     $database = new Database();
     $mysqli  = $database->getConnection();
            $checkIfExist =  "SELECT u.student_number, u.first_name, u.last_name, s.section FROM useraccounts AS u
            INNER JOIN section AS s  ON s.id = u.section WHERE u.student_number  = {$_SESSION["user_id"]}"; 
     $result = $mysqli->query($checkIfExist); 
     $userInformation =   $result->fetch_assoc();   
   
     $_SESSION['fname']  =  $userInformation['first_name'];
     $_SESSION['lname']  =  $userInformation['last_name']; 
     $_SESSION['section'] = $userInformation['section'];
 }
 else {
    header("Location: ../index.php");
    exit(); 
} 

function isPageActive($pageName) {
    return (basename(dirname($_SERVER['PHP_SELF'])) == $pageName) ? 'active' : '';
}

?>