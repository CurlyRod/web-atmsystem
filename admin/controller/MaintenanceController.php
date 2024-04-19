<?php   
 require_once("./config.php");  
 require_once("./FunctionController.php");
  
 $renderData =  new RenderAllRecord();   
 $insertData = new  RegisterNewUser(); 
 $countRows = new TotalCountRow();  
 $actionClass = new ActionClass();  

 $maintenanceClass = new MaintenanceActionClass();


if (isset($_POST['action']) && $_POST['action'] == "view") 
   { 
    $output = ''; 
    $data = $maintenanceClass->TotalRegisteredUser();  
    if ($countRows->GetAllRows() > 0)
    {
        $output .= '<table id="user_datatable" class="table table-striped table-responsive" style="width:100%; font-size:0.8rem;" >  
                    <thead > 
                        <tr >  
                          
                            <th>Student #</th>  
                            <th>RFID Tag</th> 
                            <th>Firstname</th> 
                            <th>Lastname</th>
                            <th>Section</th> 
                            <th>Email</th>  
                            <th  class="text-center">Status</th>  
                            <th  class="text-center">Verify</th>  
                            <th class="text-center">Date Created</th> 
                            <th class="text-center">Action</th>  
                        </tr>
                    </thead> 
                    <tbody>'; 
        foreach($data as $row) 
        {       
        $setStatus =  $row['status'] == 1 ? '<img src="../shared/images/check.png" style="height:14px;">' : '<img src="../shared/images/multiply.png" style="height:14px;">'; 
        $datetime = new DateTime($row['date_register']);
        $dateFiltered = $datetime->format('Y/m/d h:i A');
             $output .=' <tr>   
                        <th>'.$row['student_number'].'</th> 
                        <th>'.$row['verify_tag'].'</th>
                        <th>'.$row['first_name'].'</th> 
                        <th>'.$row['last_name'].'</th>
                        <th>'.$row['section'].'</th> 
                        <th>'.$row['email'].'</th>  
                        <th  class="text-center">'.$setStatus.'</th>
                        <th  class="text-center">'.$setStatus.'</th>
                        <th class="text-center">'.$dateFiltered.'</th>  
                        <th class="text-center">  
                        <div class="dropdown">
                        <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <img src="../shared/images/down.png">
                        </button>
                        <ul class="dropdown-menu" id="user-action-btn"> 
                            <li> <button class="dropdown-item viewBtn" data-bs-toggle="modal" data-bs-target="#view-user-modal" id='.$row['id'].'>  
                            <img src="../shared/images/eye.png"> View </button></li>
                            <li> <button class="dropdown-item editBtn"  data-bs-toggle="modal" data-bs-target="#edit-user-modal" id='.$row['id'].'> 
                            <img src="../shared/images/pencil.png"> Edit</button></li>
                            <li> <button class="dropdown-item deleteBtn" id='.$row['id'].'> <img src="../shared/images/trash.png"> Delete </button></li>
                        </ul>
                        </div>
                        </th> 
                       </tr>';
        }  
        $output .= '</tbody></table>';
        echo $output; 
    }
    else 
    {
        echo '<h3 class="text-center text-secondary"> No available data! </h3>';
    }  
}   

if (isset($_POST['edit_id']))
   {
        $userId = $_POST['edit_id'];  
        $row = $actionClass->ShowInformation($userId);  
        echo json_encode($row);
   } 
 
   if(isset($_POST['action']) && $_POST['action'] == "update"){ 

        $id = $_POST['edit_user_Id'];
        $studentNumber = $_POST["edit_student_number"];
        $firstName = $_POST['edit_fname']; 
        $middleName = $_POST['edit_mname']; 
        $lastName = $_POST['edit_lname']; 
        $email = $_POST['edit_email']; 
        $section = $_POST['edit_section'];  
        
        if (empty($id) || empty($studentNumber) || empty($firstName) || empty($lastName) || empty($email) || empty($section)) {
            $result = ["statuscode"=> 400, "message"=> "Invalid input data.", "status" => "error"];
            echo json_encode($result); 
        } else {
            try {
                $update = $actionClass->UpdateUser($id, $studentNumber, $firstName, $middleName, $lastName, $email, $section); 
                if ($update) {
                
                    $result = ["statuscode"=> 200, "message"=> "Successfully updated.", "status" => "success"];
                    echo json_encode($result); 
                } else {
                
                    $result = ["statuscode"=> 500, "message"=> "Failed to update.", "status" => "error"];
                    echo json_encode($result); 
                }
            } catch (\Throwable $th) {
          
                error_log('Exception occurred: ' . $th->getMessage());
                $result = ["statuscode"=> 500, "message"=> "An error occurred.", "status" => "error"];
                echo json_encode($result); 
            }
        }
   } 

if (isset($_POST['delete_user']) && $_POST['action'] == 'delete')
{
    $id = $_POST['delete_user']; 
    try {
        $deleteUser = $actionClass->DeleteById($id);   
        if($deleteUser)
        {
            $result = ["statuscode"=> 200, "message"=> "Successfully deleted.", "status" => "success"];
            echo json_encode($result); 
        } 

    } catch (\Throwable $th) {
       
        error_log('Exception occurred: ' . $th->getMessage());
        $result = ["statuscode"=> 500, "message"=> "An error occurred.", "status" => "error"];
        echo json_encode($result); 
    }
}
 

if (isset($_POST['action']) && $_POST['action'] == "countsection") 
{
     if ($actionClass->TotalSection() > 0) 
    { 
    $data =  $maintenanceClass->TotalRegisteredUser();
    $response = array("status"=> 200 , "total_section" =>  $data); 
    echo json_encode($response);
}
} 

if (isset($_POST['action']) && $_POST['action'] == "verify") 
{    
    $tag = $_POST['verify_tag']; 
    $code = $_POST['verify_code']; 

   try {
        $verifyUser = $maintenanceClass->VerifyUser($tag, $code); 
        if($verifyUser)
        {
            $result = ["statuscode"=> 200, "message"=> "Successfully verify.", "status" => "success"];
            echo json_encode($result); 
        }
        
   } catch (\Throwable $th) { 
    
    error_log('Exception occurred: ' . $th->getMessage());
    $result = ["statuscode"=> 500, "message"=> "An error occurred.", "status" => "error"];
    echo json_encode($result);
   }
} 

if (isset($_POST['view_id']) && $_POST['action'] == "viewinfo")
{
     $userId = $_POST['view_id'];  
     $row = $maintenanceClass->ShowInformation($userId);  
     echo json_encode($row);
}  

?>