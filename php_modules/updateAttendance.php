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
$year=$_POST['year'];
$department =$_POST['department'];
$day=date("Y-m-d");
$sql = "DELETE FROM attendanceDB where department='$department' and year='$year' and day='$day'";
$result = $conn->query($sql);

foreach($_POST['Students'] as $s){
    $roll= $s['roll'];
    $isPres= $s['isPresent'];
    $sql = "insert into attendancedb(department,year,roll,day,isPresent) values ('$department','$year','$roll','$day','$isPres')";
    $result = $conn->query($sql);
}

$conn->close();
echo json_encode( true );
?>