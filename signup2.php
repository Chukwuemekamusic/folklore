<?php
include_once('connection.php');
$firstname = $_POST['firstName'];
$lastname = $_POST['lastName'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$country = $_POST['country'];
$dob = $_POST['dob'];
$password = $_POST['password'];

// check if data exists already
$sql = "SELECT * FROM users WHERE first_name=? AND last_name=? AND email=?";
$result = $conn->prepare($sql);
$result->bind_param("sss", $firstname, $lastname, $email);
$result->execute();
$result->store_result();
if ($result->num_rows > 0) {
    echo "Contact already exists!";
    echo "<a href='signup.html'>Return to signup</a>";
    exit;
}
$result->free_result();

$sql1 = "INSERT INTO users(first_name, last_name, email, gender, country, auth, dob) VALUES('$firstname', '$lastname', '$email', '$gender', '$country', '$password', '$dob')";
$stmt = mysqli_query($conn, $sql1);
// Check if query was successful
if (mysqli_affected_rows($conn) > 0) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>