<?php 
session_start();
// session_destroy();
// session_start();
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
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
        if (!$stmt) {
            echo "Error: " . $conn->error;
            exit;
          }
        // Bind the username parameter to the prepared statement
        $stmt->bind_param("ss", $username, $password);

        // Execute the prepared statement
        $stmt->execute();

        // Get the result set from the executed statement
        $result = $stmt->get_result();

        // Check if the query returned any rows
        if(mysqli_num_rows($result) == 1) 
        {
            $row = $result->fetch_assoc();

            $_SESSION['admin'] = true;            
            $_SESSION['admin_id'] = $row['id']; 
            header('Location: admin_dashboard.php');
        }
        else 
        {
            echo "Incorrect username or password <br>";
            echo "<a href='admin_login.html'>Return to Log in!</a>";
        }
    }
?>
