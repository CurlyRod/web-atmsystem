<?php   

class RenderAllRecord {
    public function GetAllData($student)
    {      
     $database = new Database();
     $mysqli  = $database->getConnection();    

      $data = array();   
      $fetchAllData = "SELECT * FROM `monitoring` WHERE student_number = ?   ORDER BY id";  
      $stmt = $mysqli->prepare($fetchAllData); 
      $stmt->bind_param('s', $student);
      $stmt->execute();    
      $result = $stmt->get_result();
      $render = $result->fetch_all(MYSQLI_ASSOC); 
    
      foreach ($render as $row) {
        $data[] = $row;
      } 
      return $data;
     }
  } 
  class TotalCountRow {
    public function GetAllRows($student) {
        $database = new Database();
        $mysqli = $database->getConnection();  
         
        $totalCountRow = "SELECT * FROM `monitoring` WHERE student_number = ?   ORDER BY id";    
        $stmt = $mysqli->prepare($totalCountRow); 
        $stmt->bind_param('s', $student);
        $stmt->execute();   
        $stmt->store_result(); // you need to use this because for possible repeatition call. ref: https://www.php.net/manual/en/mysqli.store-result.php
        $t_rows = $stmt->num_rows; 
        $stmt->free_result(); 
        $stmt->close(); 
        return $t_rows;
    }
} 
?>