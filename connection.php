<?php 
$servername = 'lamp-database';
$dbname = 'docker';
$username = 'root';
$password = 'tiger';

$db =  new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

echo 'success';

?>