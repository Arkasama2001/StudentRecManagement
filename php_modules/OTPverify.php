<?php

// Begin of CORS things
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: X-Requested-With,Origin,Content-Type,Cookie,Accept');
$_POST = json_decode(file_get_contents("php://input"), true);









$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mca49";

$email = $_POST['email'];
// $email = "arkasama2001@gmail.com";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$currentDate = date("Y-m-d H:i:s");
$sql = "SELECT OTP
FROM otpdb
WHERE TIMESTAMPDIFF(SECOND, STR_TO_DATE(timestamp, '%Y-%m-%d %H:%i:%s'), STR_TO_DATE('$currentDate', '%Y-%m-%d %H:%i:%s')) < 300 AND Email='$email';";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$result1["OTP"] = $row["OTP"];
// echo $result;

$conn->close();
http_response_code(200);
echo json_encode($result1);
?>