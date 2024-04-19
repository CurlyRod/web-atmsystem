<?php   
    require_once './config.php'; 

    class StudentController{
    
        public function CheckUserIfExist($rfid)
        {
            $database = new Database();
            $mysqli = $database->getConnection(); 

            $checkUserIfExist  = "SELECT  v.verify_tag, u.first_name, u.last_name, u.student_number, s.time_in, s.time_out, s.section FROM verify v
            INNER JOIN useraccounts u ON v.student_number = u.student_number
            INNER JOIN section s ON s.id = u.section
            WHERE v.verify_tag = ? AND v.status = 1 
            AND s.time_in != '' AND s.time_out != '' "; 
            $stmt = $mysqli->prepare($checkUserIfExist); 
            $stmt->bind_param('s',$rfid); 
            $stmt->execute();  

            $result = $stmt->get_result();
            $is_available = $result->num_rows === 1; // I put this 1 if the user exist then the row affected is 1   
                                                    // then return = true;
            
            if ($result->num_rows === 1) {
                // User exists
                $row = $result->fetch_assoc();
                return array("exist" =>  true, "data" => $row );
            } else {
                return array("exist" => false, "message" => "Student Not exist.", "time_in" => null);
            } 
        } 

        public function CheckRecord($studentNumber, $date)
        {
            $database = new Database();
            $mysqli = $database->getConnection(); 

            $data = array();
            $checkIfAlreadyTimein  = "SELECT * FROM monitoring WHERE student_number = ? AND DATE_FORMAT(time_in, '%Y-%m-%d') = ? "; 
            $stmt = $mysqli->prepare($checkIfAlreadyTimein);  
            $stmt->bind_param('ss',$studentNumber, $date); 
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 1) {
                // User exists
                $row = $result->fetch_assoc(); 
                $timeout = $row['time_out'] !== '' && $row['time_out'] !== null ? true : false;
                return array("time_in" => true, "time_out" => $timeout, "remarks" => $row['remarks'], "status" => 308, "message" => "Already Time in.");
            } else {
                return array("time_in" => false, "status" => 302);
            }  

        } 
        
        public function TimeIn($studentNumber, $date, $remarks, $late)
        { 
            if (!is_numeric($studentNumber)) {
                return array("time_in" => false, "message" => "Invalid student number.");
            }
        
            $database = new Database();
            $mysqli = $database->getConnection();  

            $timeInUser = "INSERT INTO monitoring (student_number, time_in, remarks, late) VALUES (?, ? ,?, ?)";
            $stmt = $mysqli->prepare($timeInUser); 
            
            if (!$stmt) {
                return array("time_in" => false, "message" => "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
            } 
         
            $stmt->bind_param('ssss', $studentNumber, $date , $remarks, $late); 
            if (!$stmt->execute()) {
                return array("time_in" => false, "message" => "Execution failed: (" . $stmt->errno . ") " . $stmt->error);
            }  
            
            $checkStudent = new StudentController(); 
            $getImages = $checkStudent->GetImageById($studentNumber); 
            $image =  $getImages['data']['image'];
            return array("time_in" => true, "status" => 200, "message" => "Time in successful.", "image" =>$image, $getImages);
        
        } 

        public function TimeOut($date, $remarks, $studentNumber, $dateTimeOut)
        { 
            if (!is_numeric($studentNumber)) {
                return array("time_out" => false, "message" => "Invalid student number.");
            }
            $checkStudent = new StudentController(); 
            $getImages = $checkStudent->GetImageById($studentNumber);  

            $database = new Database();
            $mysqli = $database->getConnection();  

            $timeInUser = "UPDATE monitoring SET time_out = ?, remarks = ? WHERE student_number = ? AND  DATE_FORMAT(time_in, '%Y-%m-%d') = ?";
            $stmt = $mysqli->prepare($timeInUser); 
            
            if (!$stmt) {
                return array("time_out" => false, "message" => "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
            } 
         
            $stmt->bind_param('ssss',$date , $remarks, $studentNumber, $dateTimeOut); 
            if (!$stmt->execute()) {
                return array("time_out" => false, "message" => "Execution failed: (" . $stmt->errno . ") " . $stmt->error);
            } 
            $image =  $getImages['image'];
            return array("time_in" => true, "time_out" => true, "status" => 200, "message" => "Time Out successful.", "image" => $image, $getImages);
        
        }  

        public function GetImageById($studentNumber)
        {   

            if (!is_numeric($studentNumber)) {
                return array("student_number" => false, "message" => "Invalid student number.");
            }   
            $database = new Database();
            $mysqli = $database->getConnection(); 

            $getImage = "SELECT ac.student_number, ac.first_name, ac.last_name,  s.section, m.time_in,
            img.file_location as image, m.remarks FROM img_upload AS img
                        INNER JOIN useraccounts AS ac ON ac.student_number = img.student_number  
                        INNER JOIN monitoring AS m  
                        INNER JOIN section AS s ON ac.section =  s.id
                        WHERE ac.student_number = ? AND m.remarks = 1 LIMIT 1;"; 

            $stmt = $mysqli->prepare($getImage); 

            if (!$stmt) {
                return array("student_number" => false, "message" => "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
            }

            $stmt->bind_param('s', $studentNumber); 
            if (!$stmt->execute()) {
                return array("student_number" => false, "message" => "Execution failed: (" . $stmt->errno . ") " . $stmt->error);
            }  

            $result = $stmt->get_result(); 
            if ($result->num_rows === 0) {
                return array("student_number" => false, "message" => "No image found for the student number.", "image"=>"../assets/uploads/default.png");
            }
            $data = $result->fetch_assoc(); 
            return $result = array("data" => $data); 
         

        } 
       


    } 

 
    // if ($checkIfExist['data']['time_in'] > $timeNow )
    // {
    //     $timeIn  =  $checkStudent->TimeIn('12345678901',$dateTimeIn); 
    //     echo json_encode($timeIn);
    // }else{
    //   echo  "not late";
    // }
    
    // $checkRecord = $checkStudent->CheckRecord('12345678901', $dateNow); 

    // if ($checkRecord['time_in'] == false ) 
    // {
    //     $timeIn  =  $checkStudent->TimeIn('12345678901',$dateTimeIn); 
    //      echo json_encode($timeIn);
    // }
    // else
    // {
    //     echo json_encode($checkRecord);
    // }

//    $checkRecord = $checkStudent->CheckRecord('12345678901', $dateNow); 

//    if ($checkRecord['time_in'] == false ) 
//    {
//        $timeIn  =  $checkStudent->TimeIn('12345678901',$dateTimeIn); 
//         echo json_encode($timeIn);
//    }
//    else
//    {
//        echo json_encode($checkRecord);
//    }
  
    // if($result['available'] == 'true')
    // {
    //     date_default_timezone_set('Asia/Manila'); 
    //     $dateNow =  date("Y-m-d");   

      
    
    // }

    // try { 
        
    //     if ($is_exist ==  true) 
    //     {  
    //         date_default_timezone_set('Asia/Manila'); 
    //         $dateNow =  date("Y-m-d"); 

    //         $dateTimeIn =  date("Y-m-d h:i:s");
    //         $data =  $checkStudent->CheckRecord('12345678901',  $dateNow); 
    //         $res = $data;  
    //         if($res) 
    //         {   
    //             $response =  ["statuscode"=> 500, "message"=> "Already Time in.", "status" => "error"];;
    //             echo json_encode($response); 
    //         }else
    //         {
    //             $result = $checkStudent->TimeIn('12345678901', $dateTimeIn ); 
    //             if($result)
    //             {
    //                 $response =  ["statuscode"=> 200, "message"=> "Time in Successfully.", "status" => "error"];;
    //                 echo json_encode($response); 
    //             }
    //         }
    //     }
    // } catch (\Throwable $th) {
    //     //throw $th;
    // }
  

?>
