<?php

// Begin of CORS things
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: X-Requested-With,Origin,Content-Type,Cookie,Accept');
$_POST = json_decode(file_get_contents("php://input"), true);








if(isset($_POST)){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mca49";

$email = $_POST['email'];
$OTP = strval($_POST['otp']);
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$currentDate = date("Y-m-d H:i:s");
$sql = "UPDATE otpdb set OTP= '$OTP',timestamp='$currentDate'  where Email='$email'";
echo $sql;
$result = $conn->query($sql);


$conn->close();
}
$result1['status'] = 'success';
http_response_code(200);
echo json_encode($result1);

?>