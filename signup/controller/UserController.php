<?php    
    // this define method is use to absolute file path and target specific file. 
    // my reference : https://www.php.net/manual/en/function.define  
    
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require './controller/PHPMailer/Exception.php';
        require './controller/PHPMailer/PHPMailer.php';
        require './controller/PHPMailer/SMTP.php';

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
                
                 if($stmt->execute())
                  {    
                    $generateCode = new GenerateCode();
                    $vCode = substr(md5(uniqid(mt_rand(), true)), 0, 8);  // send unique code
                    $registerCodeResult = $generateCode->RegisterCode($studentNumber, $vCode);   
                    $fullName = $firstName .''. $lastName;
                    $sendCode =  $generateCode->SendEmail($fullName ,$vCode);
                    if ($registerCodeResult) {   
                        
                        $result =(["status" => 200 ,"message" => "Successfully Register"]); 
                        echo json_encode($result);
                    } 
                     else {
                        die("Failed to register verification code.");
                    }
                  } 
                 else 
                 {
                   die("Database error: Connection failed.");
                }                            
             } 
        }  

        class GenerateCode
        {   
            private $conn; 
            public function __construct()
            {
                $this->conn = new Database();       
            } 
            public function RegisterCode($studentNumber, $code)
            { 
              
                   $mysqli = $this->conn->getConnection();  
                    $verifyUser = "INSERT INTO verify (student_number, verify_code)  
                                                            VALUES (?, ?)";                                                            
                    $stmt = $mysqli->stmt_init();  
                    if(!$stmt->prepare($verifyUser))  
                    {    
                    die("SQL error: " . $mysqli->error);
                    }   
                    $stmt->bind_param("ss", $studentNumber, $code);          
        
                    if($stmt->execute()){
                        return true;
                    } 
                    else 
                    {
                    die("Database error: Connection failed.");
                    } 
            } 
            public function SendEmail($studentName, $verifyCode)
            {       
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'e.atmssystem@gmail.com';
                $mail->Password = 'vqih wrsg rgrf xhgf';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
        
                
                $student  = $studentName; 
                $verify = $verifyCode;
        
                $mail->setFrom('e.atmssystem@gmail.com');
                $mail->addAddress($_POST['email']);
                $mail->isHTML(true);
                $mail->Subject = "Verification Code";
                
                // Include the HTML content of the email template
                $template = file_get_contents('email_template.php');
                // Replace the verification code placeholder with the actual verification code
                $template = str_replace('{{verification_code}}', $verify, $template);
                $template = str_replace('{{student_name}}', $student, $template);
              
                $mail->Body = $template;
        
                $mail->send(); 
                ;
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            } 

      }
    }
         
?>