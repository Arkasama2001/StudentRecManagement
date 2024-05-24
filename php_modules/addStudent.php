<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: X-Requested-With,Origin,Content-Type,Cookie,Accept');
$_POST = json_decode(file_get_contents("php://input"), true);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mca49";

$student = $_POST['Student'];
// $email = "arkasama2001@gmail.com";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$first_name=$student['fName'];
$last_name=$student['lName'];
$email=$student['email'];
$state=$student['state'];
$city=$student['city'];
$phone=$student['phone'];
$rollno=$student['rollno'];
$Date_of_Birth=$student['Date_of_Birth'];
$role=$student['role'];
$year=$student['year'];
$fee_status=$student['fee_status'];
$password=$student['password'];
$Department=$student['Department'];
if($role=="Student")
$sql = "insert into studentmaindb (first_name,last_name,email,state,city,phone,rollno,Date_of_Birth,role,year,fee_status,password,Department) values ('$first_name','$last_name','$email','$state','$city','$phone','$rollno','$Date_of_Birth','$role','$year','$fee_status','$password','$Department')";
else
$sql = "insert into studentmaindb (first_name,last_name,email,state,city,phone,Date_of_Birth,role,password,Department) values ('$first_name','$last_name','$email','$state','$city','$phone','$Date_of_Birth','$role','$password','$Department')";
$result = $conn->query($sql) ;
if($result ===True){
  $sql="insert into otpdb (Email) values('$email')";
  $result = $conn->query($sql) ;
}


$conn->close();
echo json_encode( $result);
?>