<?php
 require_once("../controller/config.php"); 
$database = new Database();
$mysqli = $database->getConnection();

if(isset($_GET["email"])) {
    $checkField = "email";
    $fieldValue = $mysqli->real_escape_string($_GET["email"]);
} elseif(isset($_GET["student_number"])) {
    $checkField = "student_number";
    $fieldValue = $mysqli->real_escape_string($_GET["student_number"]);
} else {
    // Invalid request, neither email nor student_number provided
    echo json_encode(["error" => "Invalid request"]);
    exit;
}

$checkQuery = sprintf("SELECT * FROM useraccounts WHERE %s = '%s'", $checkField, $fieldValue);
$result = $mysqli->query($checkQuery);

$is_available = $result->num_rows === 0;

header("Content-Type: application/json");
echo json_encode(["available" => $is_available]);
?>
