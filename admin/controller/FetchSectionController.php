<?php  


    class FetchSection
    {
        public function GetAllSection()
        {   
            $database = new Database();
            $mysqli  = $database->getConnection(); 
              
            $query ="SELECT * FROM section where id > 1";
            $stmt = $mysqli->prepare($query);  
            $stmt->execute();    
            $result = $stmt->get_result();
            $render = $result->fetch_all(MYSQLI_ASSOC); 
            foreach ($render as $row) {
                $data[] = $row;
            } 
            return $data;
     }
    }
?>