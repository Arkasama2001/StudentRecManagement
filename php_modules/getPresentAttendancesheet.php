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
$date= $_POST['date'];

$date1 = date('Y-m-d');
$sql = "SELECT count(*) as cnt ,roll FROM attendanceDB  where department='$department' and year='$year' and isPresent='true'and day between '$date' and '$date1' group by roll " ;
$result = $conn->query($sql);

$data = $result->fetch_all( MYSQLI_ASSOC );

$conn->close();

echo json_encode( $data );
?>