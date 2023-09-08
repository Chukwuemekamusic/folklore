<?php 
// $servername = "lamp-mysql8";
// $dbname = 'folktales';
// $username = 'root';
// $password = 'tiger';

// $servername = "lamp-mysql8";
$servername = "my_docker_sql";
$dbname = 'folktales'; 
$username = 'root';
$password = 'tiger';

// $conn =  new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $db->connect_error);
// }

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

?>