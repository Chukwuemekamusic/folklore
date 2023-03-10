<?php 
    // Include the database connection file
    include_once("connection.php");

    // Check if the username and password fields are not empty
    if (empty($_POST["username"]) || empty($_POST["password"])) 
    {
        echo 'Both fields are required.';
    }
    else 
    {
        // Get the username and password values from the POST request
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare the SQL statement using a named parameter
        $stmt = $db->prepare("SELECT uid FROM users WHERE username=:username");

        // Bind the username parameter to the prepared statement
        $stmt->bindParam(":username", $username);

        // Execute the prepared statement
        $stmt->execute();

        // Get the result set from the executed statement
        $result = $stmt->get_result();

        // Check if the query returned any rows
        if(mysqli_num_rows($result) == 1) 
        {
            echo 'good boy';
        }
        else 
        {
            echo "Incorrect username or password";
        }
    }
?>
