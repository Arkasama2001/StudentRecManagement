<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: X-Requested-With,Origin,Content-Type,Cookie,Accept');
$_POST = json_decode(file_get_contents("php://input"), true);



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mca49";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// $year=1;
// $department ="MCA";
$email=$_POST['email'];
$password =$_POST['password'];

$sql = "Update studentmaindb set password='$password' where email='$email'";
$result = $conn->query($sql);


$conn->close();
echo json_encode( $result );
?>