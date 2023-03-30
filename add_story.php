<?php
session_start();
include_once('connection.php');
// Check if the user is logged in
if (!isset($_SESSION["user_id"]) && !isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Story</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link rel="stylesheet" href="./assets/css/style.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">

</head>

<body>
  <div class="container">
    <h1 class="mt-5">Add Story</h1>

    <form action="submit_story.php" method="POST" enctype="multipart/form-data">
      <!-- Continent selection -->

      <div class="form-group">
        <label for="continent">Continent</label>
        <select class="form-control" id="continent" name="continent" required>
          <option value="">-- Select a Continent --</option>
          <?php
          $sql1 = 'SELECT * FROM continents';
          $result1 = mysqli_query($conn, $sql1);
          if (!$result1) {
            die('Error retrieving categories: ' . mysqli_error($conn));
          }

          while ($row = mysqli_fetch_assoc($result1)) {
            echo '<option value="' . $row['continent_id'] . '">' . $row['name'] . '</option>'; 
          }
          ?>
        </select>
      </div>

      <!-- Legend category selection -->
      <div class="form-group">
        <label for="legend">Legend Category</label>
        <select class="form-control" id="legend" name="legend" required>
          <option value="">-- Select a Legend Category --</option>
          <?php
          $query = "SELECT * FROM legends";
          $result = mysqli_query($conn, $query);
          if (!$result) {
            die('Error retrieving categories: ' . mysqli_error($conn));
          }

          // Loop through the results and generate the option tags
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['legend_id'] . '">' . $row['name'] . '</option>'; 
          }

          ?>
          
        </select>
      </div>

      <!-- Sub-categories to help search filter #TODO COME BACK TO THIS-->
      <div class="form-group">
        <label for="sub-categories">Sub-Categories:</label>
        <select multiple class="form-control" id="sub-categories" name="sub_categories[]">
          <option value="mythical-creatures">Mythical Creatures</option>
          <option value="folklore-heroes">Folklore Heroes</option>
          <option value="legendary-places">Legendary Places</option>
          <option value="divine-beings">Divine Beings</option>
          <option value="battles">Battles</option>
          <option value="love">Love</option>
        </select>

        <!-- Story title input -->
        <div class="form-group">
          <label for="title">Story Title</label>
          <input type="text" class="form-control" id="title" name="title" required />
        </div>

        <!-- Story description input -->
        <div class="form-group">
          <label for="description">Story Description</label>
          <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <!-- Story content input -->
        <div class="form-group">
          <label for="content">Story Content</label>
          <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
        </div>

        <!-- Story tags -->
        <div class="form-group">
          <label for="story-tags">Tags (maximum of 3):</label>
          <input type="text" class="form-control" id="story-tags" name="story-tags" placeholder="Enter relevant keywords or tags">
          <small class="text-muted">Separate tags with commas</small>
        </div>
       
        <!-- <div class="form-group">
          <label for="story-tags">L:</label>
          <input type="text" class="form-control" id="story-tags" name="story-tags" placeholder="Enter relevant keywords or tags">
          <small class="text-muted">Separate tags with commas</small>
        </div> -->

        <!-- Image upload input -->
        <div class="form-group">
          <label for="image">Image Upload</label>
          <input type="file" class="form-control-file" id="image" name="image" accept="image/*" />
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Submit Story</button>
    </form>
    <a href="storyteller_landing.php"><button type='button' class='btn btn-danger'>CANCEL</button></a>
  </div>

  <!-- jQuery -->
  <!-- <script src="./assets/js/jquery-3.5.1.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- personal script  -->
  <script src="./assets/js/sign.js"></script>
  <!-- Bootstrap 4.5 JS -->
  <script src="./assets/js/bootstrap.min.js"></script>
  <!-- Popper JS -->
  <script src="./assets/js/popper.min.js"></script>
  <!-- Font Awesome -->
  <script src="./assets/js/all.min.js"></script>
</body>

</html>