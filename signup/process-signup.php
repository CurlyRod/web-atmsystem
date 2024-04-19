<?php       
    require_once('../database/config.php');
    include("./controller/UserController.php");
    require __DIR__ . "/validate.php"; 
    
    $studentNumber = $_POST['student_number'];
    $firstName = $_POST['fname']; 
    $middleName =   $_POST['mname'];
    $lastName = $_POST['lname'];  
    $email =  $_POST['email'];
    $section = $_POST['section'];
    $uniqueId = bin2hex(openssl_random_pseudo_bytes(16)); //Optional

    if(empty($studentNumber))
    {
      die("Student number is Required");  
    } 
    else if(! is_numeric($studentNumber))
    {  
        die("Student number must be a number.");
    } 

    if (empty($firstName)) 
    {
        die("First Name is Required");
    }else if(!isValidAlphabeticString($firstName))  
    {
        die("First Name must be letter"); 
    }  

    if (empty($lastName )) 
    {
        die("Last Name is Required");
    }else if(!isValidAlphabeticString($lastName )) 
    {
        die("Last Name must be letter"); 
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        die("Valid email is required");
    } 
    if(strlen($_POST['password']) < 8)
    {
        die("Password must be at least 8 Characters");
    } 
    if(! preg_match("/[a-z]/i", $_POST["password"])) 
    {
        die("Password must contain at least one letter");
    } 
    if(! preg_match("/[0-9]/i", $_POST["password"])) 
    {
        die("Password must contain at least one number");
    }
    if($_POST['password'] !== $_POST['password_confirmation']) 
    {
        die("Password must match");
    }  
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $RegisterStudent  = new UserRegister();   
    $GenerateCode = new GenerateCode();
  
    try {   
        $resultRegister =  $RegisterStudent->RegisterStudent($studentNumber, $firstName, $middleName, $lastName, $email, $section, $password_hash);    
      
    } catch (Exception $e) {
        if ($e->getCode() === 1062) {
            die("This email or student number is already in use. Please choose a different one.");
        } else {
            die("An error occurred: " . $e->getMessage());
        } 
    }
    
?>