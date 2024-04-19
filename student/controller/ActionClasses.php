<?php   

    require_once './config.php';  
    require './StudentController.php';  

    if (isset($_POST['rfid']) && $_POST['action'] == 'check-user')
    { 
        date_default_timezone_set('Asia/Manila'); 
        $dateNow = date("Y-m-d"); 
        $dateTimeInOut =  date("Y-m-d h:i A");    
        $timeNow =date('h:i A');
    
        $checkStudent = new StudentController(); 
        $checkIfExist = $checkStudent->CheckUserIfExist($_POST['rfid']);  
        
        if ($checkIfExist['exist'])
        {
            $timeInSetBySection =  date('h:i A',strtotime($checkIfExist['data']['time_in']));  // not MILITARY FORMAT  -rod
            $timeOutSetBySection = date('h:i A',strtotime($checkIfExist['data']['time_out']));  
            $studentNumber = $checkIfExist['data']['student_number']; 

            $checkRecord = $checkStudent->CheckRecord($studentNumber, $dateNow);    // this function is to ensure if the record not duplicating in the same day. -rod 
            if ($checkRecord['time_in'] == true && $checkRecord['time_out'] == true)
            {
                $result =  array("time_in" => true,"time_out" => true, "message" => "Time Out & Time In Already done for this day.");  
                // note: you need to convert it json  return in API  
                echo json_encode( $result) ; 
            }  

            if ($checkRecord['time_in'] == false) 
            {
                if (strtotime($timeNow)> $timeInSetBySection) 
                {    
                    $timeIn  =  $checkStudent->TimeIn($studentNumber, $dateTimeInOut, 1, 1); //checking for late
                    echo json_encode($timeIn);  
                }else{
                    $timeIn  =  $checkStudent->TimeIn($studentNumber, $dateTimeInOut, 1, 0); 
                    echo json_encode($timeIn);  
                }
            }
            else if ($checkRecord['time_in'] == true && $checkRecord['remarks'] == 1)
            {   
               if ($timeNow < $timeOutSetBySection) 
                {      
                    $timeOutToEarly =  array("time_in" => true,"time_out" => false, "message" => "Time Out to early for Today.");  
                    // note: you need to convert it json  return in API  
                    echo json_encode($timeOutToEarly) ; 
                }
                else
                {
                   $timeOut = $checkStudent->TimeOut($dateTimeInOut, 2 , $studentNumber, $dateNow ); 
                   echo json_encode($timeOut );
                }
            }
        }
        else
        {
            echo json_encode($checkIfExist);
        }
    
    }
?>