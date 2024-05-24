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


$year=$_POST['year'];
$department =$_POST['department'];
// $department ="MCA";
// $year=1;
$day=date("Y-m-d");
$sql = "SELECT attendanceDB.roll,attendanceDB.isPresent,studentmaindb.email FROM attendanceDB inner join studentmaindb on attendanceDB.roll=studentmaindb.rollno where attendanceDB.department='$department' and attendanceDB.year='$year' and day='$day'";
$result = $conn->query($sql);

$data = $result->fetch_all( MYSQLI_ASSOC );
if(empty($data)){
    $flse = "false";
    $student = "Student";
    $sql = "SELECT rollno as roll,email,'$flse' as isPresent FROM studentmaindb where department='$department' and year=$year and role='$student'";
    $result = $conn->query($sql);
    $data = $result->fetch_all( MYSQLI_ASSOC );
}
$conn->close();

echo json_encode( $data );
?>