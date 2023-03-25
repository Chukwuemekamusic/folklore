<?php
session_start();
include_once('connection.php');
include_once('functions.php');
$categories = get_user_details('*', 'legends');
$continents = get_user_details('*', 'continents');



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
?>

<!DOCTYPE html>
<html>

<head>
  <title>View Story</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="./tutorial/css/style.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
  <!-- <style>
		.card {
			margin-top: 20px;
			border-radius: 0;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}

		.card-header {
			background-color: #f8f9fa;
			border-bottom: 1px solid #dee2e6;
			padding: 10px 15px;
			font-weight: bold;
		}

		.card-body img {
			max-width: 100%;
			height: auto;
			margin-bottom: 10px;
		} -->
  <!-- </style> -->
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
          </li>
          <?php if (isset($_SESSION['user_id'])) { ?>
            <li class="nav-item"><a href="storyteller_landing.php" class="nav-link">Storyteller</a></li>
          <?php } elseif (isset($_SESSION['admin_id'])) { ?>
            <li class="nav-item"><a href="admin_dashboard.php" class="nav-link">Admin</a></li>
          <?php } ?>
          <!-- <li class="nav-item"><a href="#" class="nav-link">Explore Stories</a></li> -->
          <li class="nav-item dropdown">
            <?php if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) { ?>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Logout
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if (isset($_SESSION['user_id'])) { ?>
                  <a class="dropdown-item" href="logout.php">Storyteller</a>
                <?php } ?>
                <?php if (isset($_SESSION['admin_id'])) { ?>
                  <a class="dropdown-item" href="logout.php">Admin</a>
                <?php } ?>
              </div>
            <?php } else { ?>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Login/Sign-up
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="login.html">Storyteller</a>
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
      </div>
    </div>
    <div class="row justify-content-center mt-3">
      <a href="all_stories.php" type="button" class="btn btn-primary mr-3">Back to All Stories</a><br>
      <?php if(isset($_SESSION['user'])) { ?>
        <a href="storyteller_landing.php" type="button" class="btn btn-info ">Back to Your Stories</a><br>
      <?php } elseif(isset($_SESSION['admin_id'])) { ?>
        <a href="admin_landing.php" type="button" class="btn btn-info ">Back to Admin Landing</a><br>
      <?php } ?>
    </div>
  </div>
  <?php include_once('./footer.php'); ?>
</body>

</html>