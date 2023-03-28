<?php 
session_start();
// session_destroy();
// session_start();
    // Include the database connection file
    include_once("connection.php");

    // Check if the email and password fields are not empty
    if (empty($_POST["email"]) || empty($_POST["password"])) 
    {
        echo 'Both fields are required.';
    }
    else 
    {
        // Get the email and password values from the POST request
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare the SQL statement using a named parameter
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
        if (!$stmt) {
            echo "Error: " . $conn->error;
            exit;
          }
        // Bind the email parameter to the prepared statement
        $stmt->bind_param("ss", $email, $password);

        // Execute the prepared statement
        $stmt->execute();

        // Get the result set from the executed statement
        $result = $stmt->get_result();

        // Check if the query returned any rows
        if(mysqli_num_rows($result) == 1) 
        {
            $row = $result->fetch_assoc();
            $_SESSION['user'] = true;
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['user_id'] = $row['id']; 

            if ($row['is_writer'] == 1) {
                $_SESSION['writer'] = true;
                header('location: storyteller_landing.php');
            }elseif ($row['is_writer'] == 0) {
                $_SESSION['reader'] = true;
                header('Location: index.php');
            }
            
        }
        else 
        {
            echo "Incorrect email or password <br>";
            echo "<a href='login.html'>Return to Log in!</a>";
        }
    }
?>
