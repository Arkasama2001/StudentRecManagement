<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: X-Requested-With,Origin,Content-Type,Cookie,Accept');
$_POST = json_decode(file_get_contents("php://input"), true);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mca49";
$stdata = $_POST['stdata'];
$email = $stdata['email'];
$fee_status = $stdata['fee_status'];
$year = $stdata['year'];
$phone = $stdata['phone'];
// $email = "arkasama2001@gmail.com";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $sql = "SELECT first_name,last_name,email,state,city,phone,rollno,Date_of_Birth,Department,year,fee_status,role FROM studentmaindb where email='$email'";
$sql = "UPDATE studentmaindb set fee_status = '$fee_status',year = '$year', phone = '$phone' where email='$email'";
$result = $conn->query($sql);
$conn->close();

echo json_encode( $result);
?>