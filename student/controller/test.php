<?php   
    
    date_default_timezone_set('Asia/Manila');
$time = date('H:i',strtotime("10:30 PM")); 
$timeOut = date('h:i',strtotime("2:30 PM")); 
$timeNow =  date('h:i A');
if($time > $timeOut ){ 
    echo  date('h:i A'); 
    echo"not late"; 
    $timeOut;
}else{
    echo  date('H:i'); 
    echo $time;
}
?>