<?php   
   require_once("./config.php");  

   class RenderAllRecord {
     public function GetAllData()
     {      
      $database = new Database();
      $mysqli  = $database->getConnection();    

       $data = array();   
       $fetchAllData = "SELECT u.id, u.student_number, u.first_name,u.middle_name,u.last_name,u.email,s.section, u.rfid_tag ,u.date_register
       FROM useraccounts AS u
       INNER JOIN section AS s ON s.id = u.section  
       ORDER BY u.date_register DESC";  
       $stmt = $mysqli->prepare($fetchAllData);
       $stmt->execute();    
       $result = $stmt->get_result();
       $render = $result->fetch_all(MYSQLI_ASSOC); 
       foreach ($render as $row) {
         $data[] = $row;
       } 
       return $data;
     }
   } 

   class RegisterNewUser
   {
      public function GetRegisterUser($studentNumber, $firstName, $middleName, $lastName, $email, $section, $password_hash)
      { 
        
        $database = new Database();
        $mysqli = $database->getConnection();   
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

        if($stmt->execute()){
          $result = ["statuscode"=> 200, "message"=> "Successfully Register.", "status" => "success"];
          echo json_encode($result);
        } 
        else 
        {
        die("Database error: Connection failed.");
        } 
      }
   }
   
   class TotalCountRow {
    public function GetAllRows() {
        $database = new Database();
        $mysqli = $database->getConnection();  
         
        $totalCountRow = "SELECT  u.student_number, u.first_name,u.middle_name,u.last_name,u.email,s.section,u.date_register
        FROM useraccounts AS u
        INNER JOIN section AS s ON s.id = u.section";    
        $stmt = $mysqli->prepare($totalCountRow);
        $stmt->execute();   
        $stmt->store_result(); // you need to use this because for possible repeatition call. ref: https://www.php.net/manual/en/mysqli.store-result.php
        $t_rows = $stmt->num_rows; 
        $stmt->free_result(); 
        $stmt->close(); 
        return $t_rows;
    }
}  
 
 class ActionClass
 {  
    public function GetUserById($id)
    { 
    
      $database = new Database();
      $mysqli = $database->getConnection();  

      $selectById = "SELECT u.id, u.student_number, u.first_name,u.middle_name,u.last_name,u.email,s.section,u.date_register,
       u.status,u.verify,u.archive
      FROM useraccounts AS u
      INNER JOIN section AS s ON s.id = u.section  
      WHERE u.id = ? ";
      $stmt = $mysqli->prepare($selectById); 
      $stmt->bind_param('i', $id); 
      $stmt->execute();    
      $result = $stmt->get_result();
      $render = $result->fetch_all(MYSQLI_ASSOC);  
      return $render;
      
    }   

    public function ShowInformation($id)
    { 
    
      $database = new Database();
      $mysqli = $database->getConnection();  

      $selectById = "SELECT id, student_number, first_name, middle_name, last_name, email,section,rfid_tag,
      date_register, status, verify, archive
      FROM useraccounts  WHERE id = ? ";
      $stmt = $mysqli->prepare($selectById); 
      $stmt->bind_param('i', $id); 
      $stmt->execute();    
      $result = $stmt->get_result();
      $render = $result->fetch_all(MYSQLI_ASSOC);  
      return $render;
      
    } 

    public function DeleteById($id)
    {  
      $database = new Database();
      $mysqli = $database->getConnection();   

      $deleteById = "DELETE FROM useraccounts WHERE id = ?";
      $stmt = $mysqli->prepare($deleteById); 
      $stmt->bind_param('i', $id); 
      $stmt->execute();    
      return true;
      
    } 

    public function UpdateUser($id, $studentNumber, $firstName, $middleName, $lastName, $email, $section)
    {
      $database = new Database();
      $mysqli = $database->getConnection();    

      $updateUser = "UPDATE useraccounts SET student_number = ? , first_name = ?, middle_name = ?, last_name = ?, email = ?, section =? WHERE id = ?";
      $stmt = $mysqli->prepare($updateUser); 
      $stmt->bind_param('ssssssi', $studentNumber, $firstName, $middleName, $lastName, $email, $section, $id); 
      $stmt->execute();   
      return true;
    }
  
    public function ArchiveUser($id)
    {
      $database = new Database();
      $mysqli = $database->getConnection(); 

      $archiveUser  =  "UPDATE useraccounts SET archive = ? WHERE  id = ?"; 
      $stmt = $mysqli->prepare($archiveUser); 
      $stmt->bind_param("ii", 1 , $id); 

      $stmt->execute();   
      return true;
    } 

    public function TotalSection()
    { 
      $database = new Database();
      $mysqli = $database->getConnection(); 
      $totalCountRow = "SELECT * FROM section";
      $stmt = $mysqli->prepare($totalCountRow);
      $stmt->execute();   
      $stmt->store_result();
      $t_rows = $stmt->num_rows; 
      $stmt->free_result(); 
      $stmt->close(); 
      return $t_rows;
    }
 } 

  class MaintenanceActionClass
  { 
  
    public function TotalRegisteredUser(){ 
      $database = new Database();
      $mysqli = $database->getConnection();

      $totalCountRow = "SELECT u.id, u.student_number, u.first_name,u.middle_name,u.last_name,u.email,s.section, v.verify_tag ,u.date_register,v.status
      FROM useraccounts AS u 
      INNER JOIN verify as v
      INNER JOIN section AS s ON u.student_number = v.student_number and s.id = u.section
      ORDER BY u.date_register DESC";
      $stmt = $mysqli->prepare($totalCountRow); 
      $stmt->execute();    
      $result = $stmt->get_result();
      $render = $result->fetch_all(MYSQLI_ASSOC);  
      return $render;
    }    

    public function VerifyUser($rfid_tag, $verify_code)
    {
      $database = new Database();
      $mysqli = $database->getConnection();   
      $status = 1;  
      date_default_timezone_set('Asia/Manila'); 
      $dateNow =  date("Y-m-d H:i:s");
      $updateUser = "UPDATE verify SET verify_tag = ? , date_verified = ?, status = ?  WHERE verify_code = ?";
      $stmt = $mysqli->prepare($updateUser); 
      $stmt->bind_param('ssss', $rfid_tag, $dateNow, $status ,$verify_code); 
      $stmt->execute();   
      return true;
    }

   public function ShowInformation($id)
   {
      $database = new Database();
      $mysqli = $database->getConnection();  

      $selectById = "SELECT u.id, u.student_number, u.first_name,u.middle_name,u.last_name,u.email,s.id, v.verify_tag ,u.date_register,v.status
      FROM useraccounts AS u 
      INNER JOIN verify as v
      INNER JOIN section AS s ON u.student_number = v.student_number and s.id = u.section  WHERE u.id = ? 
      ORDER BY u.date_register DESC ";
      $stmt = $mysqli->prepare($selectById); 
      $stmt->bind_param('i', $id); 
      $stmt->execute();    
      $result = $stmt->get_result();
      $render = $result->fetch_all(MYSQLI_ASSOC);  
      return $render;
   }  
  }
//  class AttendanceRecord
//  {
//    function GetAttendanceNow(){
//     $database = new Database();
//     $mysqli = $database->getConnection();  


//    }
//  }

   //UNCOMMENT THIS TO THIS THE OUTPUT
//    $rec =  new RenderAllRecord(); 
//    $data = $rec->GetAllData();
//    print_r($data);
?>