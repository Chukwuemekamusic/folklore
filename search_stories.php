<?php
include('./connection.php');
include_once('./functions.php');
$stories = get_user_details('*', 'stories');
$search_query = $_POST['search-input'] ?? '';
if ($search_query){
    // $search_query = mysql_real_escape_string($search_query); #TODO CHECK THE SANITIZE FUNCTION
    $search_stories = searchStories($search_query);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore</title>
    <!-- Bootstrap 4.5 CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
</head>

<body>
<header>
    <!-- Top-bar -->

    <!-- End Top Bar -->

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
          <li class="nav-item"><a href="#" class="nav-link">Explore Stories</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Login/Sign-up
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="login.html">Storyteller</a>
              <a class="dropdown-item" href="admin_login.html">Admin</a>
            </div>
          </li>
          <!-- <li class="nav-item"><a href="#" class="nav-link">My Stories</a></li> -->
        </ul>
      </div>
    </nav>
    <!-- End Navigation -->
    <div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="text-blue">Search results</h1>
            </div>
        </div>
    </div>
</div>
  </header>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <?php
            foreach ($search_stories as $story) { ?>
                <div class="col-md-12 mb-4">
                    <div class="card ">
                        <div class="card-header">
                            <a href="view_story2.php?story_id=<?php echo $story['id'];?>">
                            <h2 class="mb-0"><?php echo ucfirst($story['title']); ?></h2>
                            </a>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($story['image_url'])) : ?>
                                <img src="<?php echo $story['image_url']; ?>" class="img-fluid mb-3 " alt="<?php echo $story['title']; ?>">
                            <?php endif; ?>
                            <p class="card-text"><?php echo nl2br($story['description']); ?></p>
                            <a href="view_story2.php?story_id=<?php echo $story['id']; ?>" class="btn btn-block">Read More</a>
                        </div>
                    </div>
                </div>

            <?php }
            ?>
        </div>
    </div>
    <!-- Script Source Files -->

    <!-- jQuery -->
    <script src="./assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap 4.5 JS -->
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Popper JS -->
    <script src="./assets/js/popper.min.js"></script>
    <!-- Font Awesome -->
    <script src="./assets/js/all.min.js"></script>

    <!-- End Script Source Files -->
</body>

</html>