<?php    
    include_once '../database/config.php';  

    $database = new Database();
    $mysqli = $database->getConnection();  

 if (isset($_FILES['imageFile'])) 
    
    $img_name = $_FILES['imageFile']['name'];
    $img_size = $_FILES['imageFile']['size'];
    $tpm_name = $_FILES['imageFile']['tmp_name']; 
    $error    = $_FILES['imageFile']['error']; 

   if ($error === 0)
   {
        if($img_size > 5000000)
        {
            $errorMessage = "File too Large to Upload.";  
            $error = array('error'=> 1, 'errorMessage'=> $errorMessage); 
           
            echo json_encode($error); 
            exit();
        }else{
             $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);  
             
             $img_extension_filter = strtolower($img_extension); 
             $allowed_file = array("jpg", "png","jpeg"); 

             if (in_array($img_extension_filter, $allowed_file))
             {      
                 $studentNumber = "12345678901";
                 $new_Image_file = uniqid("IMG-", true).'.'.$img_extension_filter; 
                 $img_upload_path  = "../assets/uploads/".$new_Image_file; 
                 move_uploaded_file($tpm_name, $img_upload_path);  
              
                //  $insertImage = "INSERT INTO img_upload (student_number, filename, file_location) VALUES (?, ?, ?)"; 
                //  $stmt = $mysqli->stmt_ini
                //t();  
                //  $stmt->prepare($insertImage);   
                //  $stmt->bind_param("sss",  $studentNumber, $new_Image_file, $img_upload_path);
                //     if ($stmt->execute())
                //     {
                //         $result = array("status" => 200, "message"=>"Uploaded Successfully", "src"=> $img_upload_path); 
                //         echo json_encode($result);
                //         exit();
                //     } 
                //     else 
                //     {
                //         die("Database error: Connection failed.");
                //     }  
              
                // Assuming $mysqli is your MySQLi connection object

                // Check if the student number exists
                // $checkQuery = "SELECT COUNT(*) AS count FROM img_upload WHERE student_number = ?";
                // $stmtCheck = $mysqli->prepare($checkQuery);
                // $stmtCheck->bind_param("s", $studentNumber);
                // $stmtCheck->execute();
                // $resultCheck = $stmtCheck->get_result();
                // $row = $resultCheck->fetch_assoc();
                // $count = $row['count'];

                // if ($count > 0) {
                //     // If the student number exists, perform an update
                //     $updateQuery = "UPDATE img_upload SET filename = ?, file_location = ? WHERE student_number = ?";
                //     $stmtUpdate = $mysqli->prepare($updateQuery);
                //     $stmtUpdate->bind_param("sss", $new_Image_file, $img_upload_path, $studentNumber);
                    
                //     if ($stmtUpdate->execute()) {
                //         $result = array("status" => 200, "message" => "Updated Successfully", "src" => $img_upload_path); 
                //         echo json_encode($result);
                //         exit();
                //     } else {
                //         die("Database error: Update failed.");
                //     }
                // } else {
                //     // If the student number does not exist, perform an insert
                //     $insertQuery = "INSERT INTO img_upload (student_number, filename, file_location) VALUES (?, ?, ?)";
                //     $stmtInsert = $mysqli->prepare($insertQuery);
                //     $stmtInsert->bind_param("sss", $studentNumber, $new_Image_file, $img_upload_path);
                    
                //     if ($stmtInsert->execute()) {
                //         $result = array("status" => 200, "message" => "Inserted Successfully", "src" => $img_upload_path); 
                //         echo json_encode($result);
                //         exit();
                //     } else {
                //         die("Database error: Insert failed.");
                //     }
                // }

        
            

            // Check if the student number exists
            $checkQuery = "SELECT COUNT(*) AS count, file_location FROM img_upload WHERE student_number = ?";
            $stmtCheck = $mysqli->prepare($checkQuery);
            $stmtCheck->bind_param("s", $studentNumber);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result();
            $row = $resultCheck->fetch_assoc();
            $count = $row['count'];
            $fileLocation = $row['file_location'];

            if ($count > 0) {
                // If the student number exists, fetch the file path
                // Perform update
                $updateQuery = "UPDATE img_upload SET filename = ?, file_location = ? WHERE student_number = ?";
                $stmtUpdate = $mysqli->prepare($updateQuery);
                $stmtUpdate->bind_param("sss", $new_Image_file, $img_upload_path, $studentNumber);
                
                if ($stmtUpdate->execute()) {
                    // Delete the actual image file
                    if (file_exists($fileLocation)) {
                        unlink($fileLocation);
                    }
                    
                    $result = array("status" => 200, "message" => "Updated Successfully", "src" => $img_upload_path); 
                    echo json_encode($result);
                    exit();
                } else {
                    die("Database error: Update failed.");
                }
            } else {
                // If the student number does not exist, perform an insert
                $insertQuery = "INSERT INTO img_upload (student_number, filename, file_location) VALUES (?, ?, ?)";
                $stmtInsert = $mysqli->prepare($insertQuery);
                $stmtInsert->bind_param("sss", $studentNumber, $new_Image_file, $img_upload_path);
                
                if ($stmtInsert->execute()) {
                    $result = array("status" => 200, "message" => "Inserted Successfully", "src" => $img_upload_path); 
                    echo json_encode($result);
                    exit();
                } else {
                    die("Database error: Insert failed.");
                }
            }
             }
             else
             {
                $errorMessage = "File was not Supported.";  
                $error = array('error'=> 1, 'errorMessage'=> $errorMessage); 
                echo json_encode($error); 
                exit();   
             }
        }
   }
   else{
      $errorMessage = "Unknown error occured";  
      $error = array('error'=> 1, 'errorMessage'=> $errorMessage); 
      echo json_encode($error); 
      exit();
   } 


?>