<?php
include_once('connection.php');
$firstname = $_POST['firstName'];
$lastname = $_POST['lastName'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$country = $_POST['country'];
$dob = new DateTime($_POST['dob']);
$dob = $dob->format('Y-m-d');
$password = $_POST['password'];
$is_writer = 1;

// check if data exists already
$sql = "SELECT * FROM users WHERE first_name=? AND last_name=? AND email=?";
$result = $conn->prepare($sql);
$result->bind_param("sss", $firstname, $lastname, $email);
$result->execute();
$result->store_result();
if ($result->num_rows > 0) {
    echo "Contact already exists! <br>";
    echo "<a href='signup.html'>Return to signup</a>";
    exit;
}
$result->free_result();

$sql1 = "INSERT INTO users(first_name, last_name, email, gender, country, password, dob, is_writer) 
        VALUES(?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql1);
if (!$stmt) {
    echo "Error: " . $conn->error;
    exit;
  }
$stmt->bind_param("sssssssi", $firstname, $lastname, $email, $gender, $country, $password, $dob, $is_writer);

if ($stmt->execute()) {
  header('Location: login.html');
} else {
  echo "Error: " . $stmt->error;
}
?>