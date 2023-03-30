<?php
session_start();
include_once('connection.php');
include_once('functions.php');
include_once('./php_sharing_buttons/sharingbuttons.php');
$categories = get_user_details('*', 'legends');
$continents = get_user_details('*', 'continents');

// $loggedIn = isLoggedIn();
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'] ?? '';
  $user_name = get_single_detail("first_name", "users", "id = $user_id");
}


if (!isset($_GET['story_id'])) {
  header("Location: storyteller_landing.php");
}
$story_id = $_GET['story_id'];
$sql = "SELECT * FROM stories WHERE id=?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
  echo "Error: " . $conn->error;
}
$stmt->bind_param("i", $story_id);
$stmt->execute();
$result = $stmt->get_result();
$story = $result->fetch_assoc();

update_story_views($story_id);

$avg_rating = get_single_detail('rating', 'stories', "id = $story_id");
$author_id = get_single_detail('author_id', 'stories', "id=$story_id");
$author_fullname = get_fullname("first_name", "last_name", "users", "id = $author_id");
?>

<!DOCTYPE html>
<html>

<head>
  <title>View Story</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- rateyo star lib -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
  <!-- social media css button -->
  <link rel="stylesheet" href="./php_sharing_buttons/sharingbuttons.css">
  <!-- <link rel="stylesheet" type="text/css" href="jquery.rateyo.min.css">  -->
  <!-- personal css lib -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
  <!-- jQuery -->
  <script src="./assets/js/jquery-3.5.1.min.js"></script>
  <!-- Bootstrap 4.5 JS -->
  <script src="./assets/js/bootstrap.min.js"></script>
  <!-- jquery rateYo -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
</head>

<body>
  <header>
    <!-- Navigation -->
    <nav class="navbar bg-light navbar-light navbar-expand-lg">
      <div class="container">
        <a href="" class="navbar-brand">logo</a>
      </div>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div id="navbarResponsive" class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item"><a href="index.php" class="nav-link active">Home</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              Explore
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li class="dropdown dropend">
                <a class="dropdown-item dropdown-toggle" href="#" id="multilevelDropdownMenu1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  By Category
                </a>
                <ul class="dropdown-menu" aria-labelledby="multilevelDropdownMenu1">
                  <?php
                  foreach ($categories as $category) { ?>
                    <li><a class="dropdown-item" href="legend_stories.php?category_id=<?php echo $category['legend_id'] ?>"><?php echo $category['name'] ?></a></li>
                  <?php } ?>
                </ul>
              </li>
              <li class="dropdown dropend">
                <a class="dropdown-item dropdown-toggle" href="#" id="multilevelDropdownMenu1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  By Continent
                </a>
                <ul class="dropdown-menu" aria-labelledby="multilevelDropdownMenu1">
                  <?php
                  foreach ($continents as $continent) { ?>
                    <li><a class="dropdown-item" href="legend_stories.php?continent_id=<?php echo $continent['continent_id'] ?>"><?php echo $continent['name'] ?></a></li>
                  <?php } ?>
                </ul>
              </li>
              <li><a class="dropdown-item" href="./all_stories.php">All Stories</a></li>
            </ul>
          </li>
          <?php if (isset($_SESSION['writer'])) { ?>
            <li class="nav-item"><a href="storyteller_landing.php" class="nav-link">Storyteller</a></li>
          <?php } elseif (isset($_SESSION['admin_id'])) { ?>
            <li class="nav-item"><a href="admin_dashboard.php" class="nav-link">Admin</a></li>
          <?php } elseif (isset($_SESSION['reader'])) { ?>
            <li class="nav-item"><a href="#" class="nav-link">Hi <?php echo $user_name ?></a></li>
          <?php } ?>
          </li>
          <!-- <li class="nav-item"><a href="#" class="nav-link">Explore Stories</a></li> -->
          <li class="nav-item dropdown">
            <?php if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) { ?>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Logout
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if (isset($_SESSION['writer'])) { ?>
                  <a class="dropdown-item" href="logout.php">Storyteller</a>
                <?php } ?>
                <?php if (isset($_SESSION['admin_id'])) { ?>
                  <a class="dropdown-item" href="logout.php">Admin</a>
                <?php } ?>
                <?php if (isset($_SESSION['reader'])) { ?>
                  <a class="dropdown-item" href="logout.php">Goodbye <?php echo $user_name ?></a>
                <?php } ?>
              </div>
            <?php } else { ?>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Login/Sign-up
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="login.html">Storyteller</a>
                <a class="dropdown-item" href="login_user.html">Storyseeker</a>
                <a class="dropdown-item" href="admin_login.html">Admin</a>
              </div>
            <?php } ?>
          </li>
          <li class="nav-item">
            <form class="form-inline ml-auto flex-nowrap" method="POST" action="search_stories.php">
              <input class="form-control mr-sm-2" id="search-input" name="search-input" type="search" placeholder="Search for stories" aria-label="Search">
              <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navigation -->

  </header>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h2 class="mb-0"><?php echo ucfirst($story['title']); ?></h2>
          </div>
          <div class="card-body">
            <?php if (!empty($story['image_url'])) : ?>
              <img src="<?php echo $story['image_url']; ?>" class="img-fluid mb-3" alt="<?php echo $story['title']; ?>">
            <?php endif; ?>
            <p class="card-text"><?php echo nl2br($story['content']); ?></p>
          </div>
        </div>
        <!-- author's name -->
        <div class="mt-2 text-right"><i>story by</i> <?php echo $author_fullname ?></div>
      </div>

    </div>

    <form class="form-group">

      <div class="rateyo" id="rating" data-rateyo-rating="<?php echo $avg_rating; ?>" data-rateyo-num-stars="5" data-rateyo-score="3">
      </div>

      <!-- Show a login modal when the user clicks the rating button -->
      <div id="login-modal" style="display: none;">
        <p>Please sign in to rate this story.</p>
        <a href="/login">Sign in</a>
      </div>

      <span id='results'><?php echo $avg_rating; ?></span>

      <label for="rating-input">Rating</label>
      <input type="hidden" name="rating" id="rating-input">
      <input type="hidden" name="story_id" id="story_id" value="<?php echo $story_id; ?>">
      <div id="story-rating" class="mb-3"></div>
      <button id="submit-btn" class="btn btn-outline-primary">Rate Story</button>
      <div id="error-message" style="display:none;color:red;">You must be logged in to rate this story <br><a href="login.html">Click here</a></div>
      <!-- #TODO send them back to the story page after logging in -->
    </form>

    <div class="row justify-content-center mt-3 mb-3">
      <a href="all_stories.php" type="button" class="btn btn-primary mr-3">Back to All Stories</a><br>
      <?php if (isset($_SESSION['writer'])) { ?>
        <a href="storyteller_landing.php" type="button" class="btn btn-info ">Back to Your Stories</a><br>
      <?php } elseif (isset($_SESSION['admin_id'])) { ?>
        <a href="admin_landing.php" type="button" class="btn btn-info ">Back to Admin Landing</a><br>
      <?php } ?>
    </div>
    <br>
    <hr>

    <?php
    showSharer("http://localhost/app/folklore/view_story2.php?story_id=9", "Read this amazing story!");
    ?>
  </div>

  <!-- Script Source Files -->


  <!-- <script src="./rating.js"></script> -->
  <script>
    $(function() {

      // Initialize RateYo
      $("#rating").rateYo({
        rating: 3.5,
        halfStar: true,
        precision: 1,
        onSet: function(rating, rateYoInstance) {
          // Set the rating input value when the rating is changed
          $('#rating-input').val(rating);
          // display result
          $('#results').text(rating);
        }
      });


      // Handle form submission
      $('#submit-btn').click(function(e) {
        e.preventDefault();

        if (!<?php echo isset($_SESSION['user_id']) || isset($_SESSION['admin_id']) ? 'true' : 'false' ?>) {
          $('#error-message').css('display', 'block');
          return;
        }

        // Get the rating value and story ID
        var rating = $('#rating-input').val();
        var story_id = $('#story_id').val();

        // Post the rating to the server using AJAX
        $.ajax({
          url: './rate_story.php',
          type: 'POST',
          data: {
            rating: rating,
            story_id: story_id
          },
          success: function(data) {
            // Handle the server response
            console.log("Rating saved!");
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log('AJAX Error: ' + textStatus + ' ' + errorThrown);
          }
        });
      });
    });
  </script>

  <!-- dropdownMenuLink js -->
  <script src="./assets/js/nav.js"></script>
  <!-- Popper JS -->
  <script src="./assets/js/popper.min.js"></script>
  <!-- Font Awesome -->
  <script src="./assets/js/all.min.js"></script>

  <!-- End Script Source Files -->


</body>

</html>