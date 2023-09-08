<?php
session_start();
include('./connection.php');
include_once('./functions.php');
$categories = get_user_details('*', 'legends');
$continents = get_user_details('*', 'continents');
$stories = get_user_details('*', 'stories', '', 'views DESC');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'] ?? '';
    $user_name = get_single_detail("first_name", "users", "id = $user_id");
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
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <!-- <li class="nav-item"><a href="#" class="nav-link">My Stories</a></li> -->
                </ul>
            </div>
        </nav>
        <!-- End Navigation -->

        <div class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="text-blue">Our Stories</h1>
                    </div>
                </div>
               
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <?php
            foreach ($stories as $story) { ?>
                <div class="col-md-12 mb-4">
                    <div class="card ">
                        <div class="card-header">
                            <a href="view_story2.php?story_id=<?php echo $story['id']; ?>">
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

    <?php include_once('./footer.php'); ?>

    <!-- End Script Source Files -->
</body>

</html>