<?php
session_start();
ob_start();
include_once('connection.php');

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if (isset($_GET["id"])) {
    $story_id = $_GET["id"];
} else {
    header("Location: storyteller_landing.php");
    exit();
}

// Retrieve the current story details
$sql = "SELECT * FROM stories WHERE id = ? AND author_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $story_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Story does not exist or does not belong to the logged in user
    header("Location: storyteller_landing.php");
    exit();
}

$story = $result->fetch_assoc();

// Update the story if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $storyTitle = $_POST['title'];
    $storyDescription = $_POST['description'];
    $storyContent = $_POST['content'];

    $sql = "UPDATE stories SET title = ?, description = ?, content = ? WHERE id = ? AND author_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $storyTitle, $storyDescription, $storyContent, $story_id, $user_id);

    if ($stmt->execute()) {
        header("Location: storyteller_landing.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
ob_end_flush();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Story - Storyteller</title>
    <!-- include your CSS and JS files here -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./tutorial/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">

</head>

<body>
    <div class="container py-5 px-5">
        <!-- <div class="row justify-content-center"> -->
            <!-- <div class="col-md-6 col-lg-5"> -->
                <div class="card border-0 shadow">
                    <h1 class="mt-5">Edit Story</h1>
                    <form method="POST">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $story['title']; ?>" required><br>

                            <label for="description">Description:</label>
                            <input type="text" class="form-control" name="description" value="<?php echo $story['description']; ?>" required><br>

                            <label for="content">Content:</label>
                            <textarea name="content" class="form-control" required><?php echo $story['content']; ?></textarea><br>

                            <input type="submit" value="Save Changes" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            <!-- </div> -->
        <!-- </div> -->
</div>
    <!-- jQuery -->
    <script src="./tutorial/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap 4.5 JS -->
    <script src="./tutorial/js/bootstrap.min.js"></script>
    <!-- Popper JS -->
    <script src="./tutorial/js/popper.min.js"></script>
    <!-- Font Awesome -->
    <script src="./tutorial/js/all.min.js"></script>
</body>

</html>