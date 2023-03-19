<?php
session_start();
ob_start();
include_once('connection.php');

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit();
}

// validate user input to avoid sql injection
$user_id = $_SESSION["user_id"];
$continentID = htmlspecialchars($_POST["continent"]);
$legendID = htmlspecialchars($_POST["legend"]);
$storyTitle = trim(htmlspecialchars($_POST['title']));
$storyDescription = htmlspecialchars($_POST['description']);
$storyContent = htmlspecialchars($_POST['content']);
// checks if tags are available before exploding
$tags = isset($_POST["story-tags"]) ? explode(',', $_POST["story-tags"]) : [];

$sql = "INSERT INTO stories (continent_id, legend_id, author_id, title, description, content) 
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Error: " . $conn->error;
    exit;
}
$stmt->bind_param("iiisss", $continentID, $legendID, $user_id, $storyTitle ,$storyDescription, $storyContent);
if ($stmt->execute()) {
  // retrieve the story_id
  $story_id = $conn->insert_id;
  
  foreach ($tags as $tag) {
    $stmt = $conn->prepare("CALL insert_tag(?, ?)");
    $stmt->bind_param("is", $story_id, trim($tag));
    $stmt->execute();
    $stmt->close();
  }

  header('Location: storyteller_landing.php');
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
ob_end_flush();
?>

