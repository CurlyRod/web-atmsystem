<?php
 require_once("../controller/config.php"); 
 $database = new Database();
 $mysqli = $database->getConnection();
 

if(isset($_GET["verify_code"])) {
    $checkField = "verify_code";
    $fieldValue = $mysqli->real_escape_string($_GET["verify_code"]);

} elseif(isset($_GET["verify_tag"])) {
    $checkField = "verify_tag";
    $fieldValue = $mysqli->real_escape_string($_GET["verify_tag"]);

} else {
  
    echo json_encode(["error" => "Invalid request"]);
    exit;
}

$checkQuery = sprintf("SELECT * FROM verify WHERE %s = '%s' and status = 1", $checkField, $fieldValue);
$result = $mysqli->query($checkQuery);

$is_available = $result->num_rows === 0; 

header("Content-Type: application/json");
echo json_encode(["available" => $is_available]);
?>
