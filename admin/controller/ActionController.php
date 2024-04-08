<?php   
   require_once("./config.php");  
   require_once("./FunctionController.php"); 
   $renderData =  new RenderAllRecord();   
   $insertData = new  RegisterNewUser(); 
   $countRows = new TotalCountRow();  
   $actionClass = new ActionClass();

   if (isset($_POST['action']) && $_POST['action'] == "view") 
   { 
    $output = ''; 
    $data = $renderData->GetAllData();  
    if ($countRows->GetAllRows() > 0)
    {
        $output .= '<table id="user_datatable" class="table table-striped table-responsive" style="width:100%">  
                    <thead > 
                        <tr >       
                            <th>Student #</th> 
                            <th>Firstname</th> 
                            <th>Lastname</th>
                            <th>Section</th> 
                            <th>Email</th> 
                            <th class="text-center">Date Created</th> 
                            <th class="text-center">Action</th>  
                        </tr>
                    </thead> 
                    <tbody>'; 
        foreach($data as $row) 
        {       
        $datetime = new DateTime($row['date_register']);
        $dateFiltered = $datetime->format('Y/m/d h:i A');
             $output .=' <tr>  
                        <th>'.$row['student_number'].'</th>
                        <th>'.$row['first_name'].'</th> 
                        <th>'.$row['last_name'].'</th>
                        <th>'.$row['section'].'</th> 
                        <th>'.$row['email'].'</th> 
                        <th class="text-center">'.$dateFiltered.'</th>  
                        <th class="text-center">  
                        <div class="dropdown">
                        <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <img src="../shared/images/down.png">
                        </button>
                        <ul class="dropdown-menu" id="user-action-btn"> 
                            <li> <button class="dropdown-item viewBtn" data-bs-toggle="modal" data-bs-target="#view-user-modal" id='.$row['id'].'>  
                            <img src="../shared/images/eye.png"> View </button></li>
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

   if (isset($_POST['action']) && $_POST['action'] == "countuser") 
   {
      if ($countRows->GetAllRows() > 0) 
      { 
        $data =  $countRows->GetAllRows();
        $response = array("status"=> 200 , "total_user" =>  $data); 
        echo json_encode($response);
      }
   }
   
   if(isset($_POST['action']) && $_POST['action'] == "insert")
   {    

        $studentNumber = $_POST['student_number'];
        $firstName = $_POST['fname']; 
        $middleName =   $_POST['mname'];
        $lastName = $_POST['lname'];  
        $email =  $_POST['email'];
        $section = $_POST['section']; 
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);  

        try {
            $insertData->GetRegisterUser($studentNumber, $firstName, $middleName, $lastName, $email, $section, $password_hash);
        } catch (\Throwable $th) { 
            error_log('Exception occurred: ' . $th->getMessage());
        }
   } 

    if (isset($_POST['view_id']) && $_POST['action'] == "viewinfo")
    {
         $userId = $_POST['view_id'];  
         $row = $actionClass->ShowInformation($userId);  
         echo json_encode($row);
    }  

    if (isset($_POST['action']) && $_POST['action'] == "countsection") 
    {
       if ($actionClass->TotalSection() > 0) 
       { 
         $data =  $actionClass->TotalSection();
         $response = array("status"=> 200 , "total_section" =>  $data); 
         echo json_encode($response);
       }
    }
?>