<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: webpage.html");
}

$user_id = $_SESSION['user_id'];
$firstname = $_SESSION['first_name'];
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Storyteller Landing Page</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="./tutorial/css/style.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar bg-light">
    <a class="navbar-brand" href="#">Storyteller</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link active" href="storyteller_landing.php">My Stories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_story.php">New Story</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Edit Profile</a>
        </li>
        <li class="nav-item font-weight-bold">
          <a class="nav-link" href="./index.php">Home</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
      </form>
      <a class="btn btn-danger ml-2" href="./logout.php">Log Out</a>
    </div>
  </nav>

  <div class="container mt-4">
    <h1 class="mb-4">My Stories</h1>
    <ul class="list-group">
      <?php
      $sql = "SELECT * FROM stories WHERE author_id=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $user_id);
      $stmt->execute();
      $result = $stmt->get_result();
      while ($row = $result->fetch_assoc()) {
        $story_id = $row['id'];  #TODO change to story_id
        $title = $row['title'];
        $views = $row['views'];
        $imagePath = $row['image_url'];
      ?>
        
        <li class="list-group-item">
          <a href="view_story2.php?story_id=<?php echo $story_id; ?>"><?php echo $title; ?></a> 
          <div class="btn-group float-right" role="group">
            <a href="edit_story.php?id=<?php echo $story_id ?>" class="btn btn-primary mr-3">Edit</a>
            <a href="delete_story.php?id=<?php echo $story_id ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this story?')">Delete</a>
          
          </div>
          <div class="float-right mr-4 badge-md badge-info badge-pill">Views: <?php echo $views; ?></div>
         
        </li>
      <?php } ?>
    </ul>
    <div class="text-center mt-4">
      <a href="add_story.php" class="btn btn-primary">Add New Story</a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT" ></script>
  </body>
  </html>;