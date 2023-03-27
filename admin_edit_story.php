<?php
session_start();
ob_start();
include_once('connection.php');
if (!$_SESSION['admin_id']) {
    header('Location: index.php');
}

// Check if the user is logged in
// if (!isset($_SESSION["admin"]))  {
//     header("Location: login.php");
//     exit();
// }

// $admin_id = $_SESSION["admin_id"] ?? '';

if (isset($_GET["id"])) {
    $story_id = $_GET["id"];
} else {
    header("Location: admin_landing.php");
    exit();
}

// Retrieve the current story details
$sql = "SELECT stories.*, GROUP_CONCAT(tags.name) AS tags
        FROM stories
        LEFT JOIN story_tag ON stories.id = story_tag.story_id
        LEFT JOIN tags ON story_tag.tag_id = tags.tag_id
        WHERE stories.id =? 
        GROUP BY stories.id";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $story_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Story does not exist or does not belong to the logged in user
    header("Location: admin_landing.php");
    exit();
}

$story = $result->fetch_assoc();
// $oldTags = $story['tags'];

// Update the story if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $storyTitle = htmlspecialchars($_POST['title']);
    $storyDescription = htmlspecialchars($_POST['description']);
    $storyContent = htmlspecialchars($_POST['content']);
    $storyTags = isset($_POST["story-tags"]) ? explode(',', htmlspecialchars($_POST["story-tags"])) : [];

    $sql = "UPDATE stories SET title = ?, description = ?, content = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $storyTitle, $storyDescription, $storyContent, $story_id);

    if ($stmt->execute()) {

        //compare the 2;
        if ($storyTags) { 
            // Delete existing tags for the story
            $sql = "DELETE FROM story_tag WHERE story_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $story_id);
            $stmt->execute();
            $stmt->close();
          
            // Insert the new tags into the database
            $insertStmt = $conn->prepare("CALL insert_tag(?, ?)");
            foreach ($storyTags as $tag) {
              $insertStmt->bind_param("is", $story_id, trim($tag));
              $insertStmt->execute();
            }
            $insertStmt->close();
            header("Location: admin_landing.php");
            exit();
        } else {
        echo "Error: " . $stmt->error;
        }
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
    <title>Edit Story - Admin</title>
    <!-- include your CSS and JS files here -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./tutorial/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">

</head>

<body>
    <div class="container py-5 ">
        <!-- <div class=$oldTags = $story['tags'];"row justify-content-center"> -->
            <!-- <div class="col-md-6 col-lg-5"> -->
                <div class="card border-0 shadow p-3">
                    <h1 class="mt-5">Edit Story</h1>
                    <form method="POST">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $story['title']; ?>" required><br>

                            <label for="description">Description:</label>
                            <input type="text" class="form-control" name="description" value="<?php echo $story['description']; ?>" required><br>

                            <label for="content">Content:</label>
                            <textarea name="content" class="form-control" rows="10" required><?php echo $story['content']; ?></textarea><br>
                            
                            <label for="story-tags">Tags (maximum of 3):</label>
                            <input type="text" class="form-control" id="story-tags" name="story-tags" value="<?php echo $story['tags']; ?>"><br>
                            <small class="text-muted">Separate tags with commas</small> <br>


                            <input type="submit" value="Save Changes" class="btn btn-primary">
                        </div>
                    </form>
                   <a href="./admin_landing.php"><input type="button" value="CANCEL" class="btn btn-danger"></a>
                </div>
            <!-- </div> -->
        <!-- </div> -->
</div>
    <!-- jQuery -->
  <!-- <script src="./tutorial/js/jquery-3.5.1.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- personal script  -->
  <script src="./assests/js/sign.js"></script>
  <!-- Bootstrap 4.5 JS -->
  <script src="./tutorial/js/bootstrap.min.js"></script>
  <!-- Popper JS -->
  <script src="./tutorial/js/popper.min.js"></script>
  <!-- Font Awesome -->
  <script src="./tutorial/js/all.min.js"></script>
</body>

</html>