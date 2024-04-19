<?php 
    require_once './config.php'; 
    include './FunctionController.php';
   $renderData =  new RenderAllRecord(); 
   $countRows = new TotalCountRow();  

   if (isset($_POST['action']) && $_POST['action'] == "view") 
   {    
    $student = $_POST['student_number']; 
    $output = ''; 
    $data = $renderData->GetAllData($student);  
    if ($countRows->GetAllRows($student) > 0)
    {
        $output .= '<table id="user_datatable" class="table table-striped table-responsive" style="width:100%">  
                    <thead > 
                        <tr >       
                            <th>Student #</th>
                            <th>Time in</th> 
                            <th>Time out</th>
                            <th class="text-center">Action</th>  
                        </tr>
                    </thead> 
                    <tbody>'; 
        foreach($data as $row) 
        {       
        $datetimeIn = new DateTime($row['time_in']);
        $dateFiltered = $datetimeIn->format('Y/m/d h:i A');
             $output .=' <tr>  
                        <th>'.$row['student_number'].'</th> 
                        <th class="text-center">'.$dateFiltered.'</th>  
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
?>