<?php
include_once('connection.php');
include_once('functions.php');
$categories = get_user_details('*', 'legends');
$continents = get_user_details('*', 'continents');
?>

<nav class="navbar bg-light navbar-light navbar-expand-lg">
    <div class="container">
        <a href="" class="navbar-brand">logo</a>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navbarResponsive" class="collapse navbar-collapse">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="index.php" class="nav-link <?php echo ($_SERVER['PHP_SELF'] == './index.php') ? 'active' : ''; ?>">Home</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php echo ($_SERVER['PHP_SELF'] == './legend_stories.php') ? 'active' : ''; ?>" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
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
            <!-- <li> -->
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
                    <a class="nav-link dropdown-toggle <?php echo ($_SERVER['PHP_SELF'] == '/login.html.php' ||$_SERVER['PHP_SELF'] == '/admin_login.html.php') ? 'active' : ''; ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <!-- <li class="nav-item"><a href="#" class="nav-link">My Stories</a></li> -->
        </ul>
    </div>
</nav>