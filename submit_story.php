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

//Process and upload the image
$storyImage = $_FILES['image'] ?? null;
$imagePath = '';

if (!is_dir('./images')) {
  if (mkdir('images', 511)){
    echo "successful";
  }else {
    echo "Error: " . $conn->error;    
  }
}
$allowedTypes = array("jpg", "jpeg", "png", "gif"); #TODO ensure that upload image are of a type

if ($storyImage && $storyImage['tmp_name']) {
  if ($storyImage['error'] === 0) {
    $storyExt = strtolower(end(explode('.',$storyImage['name'])));
    
    if (in_array($storyExt, $allowedTypes)){
      $imagePath = 'images/'.randomStr().'/'.$storyImage['name'];
      mkdir(dirname($imagePath));
      move_uploaded_file($storyImage['tmp_name'], $imagePath);
    } else {
      Echo 'Wrong file extension format';
    }

  }else {
    Echo 'Error uploading Image!';
  }

}



$sql = "INSERT INTO stories (continent_id, legend_id, author_id, title, description, content, image_url) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Error: " . $conn->error;
    exit;
}
$stmt->bind_param("iiissss", $continentID, $legendID, $user_id, $storyTitle ,$storyDescription, $storyContent, $imagePath);
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

function randomStr($n=8) {        //Stephen watkins https://stackoverflow.com/questions/4356289/php-random-string-generator
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

$stmt->close();
$conn->close();
ob_end_flush();
?>
