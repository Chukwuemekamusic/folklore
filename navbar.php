<?php
include_once('connection.php');
include_once('functions.php');
$categories = get_user_details('*', 'legends');
$continents = get_user_details('*', 'continents');
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Folktales & Myths</title>
    <!-- Bootstrap 4.5 CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
</head>

<body>


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
                                By Categories
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
                                By Categories
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="multilevelDropdownMenu1">
                                <?php
                                foreach ($continents as $continent) { ?>
                                    <li><a class="dropdown-item" href="legend_stories.php?continent_id=<?php echo $continent['continent_id'] ?>"><?php echo $continent['name'] ?></a></li>
                                <?php } ?>
                                
                            </ul>
                            <li><a class="dropdown-item" href="#">Action</a></li>
                        </li>
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
    <!-- #TODO add REFERENCES https://www.codeply.com/p/rhCuZhEUrk -->
    <!-- Script Source Files -->

    <!-- jQuery -->
    <script src="./assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap 4.5 JS -->
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- dropdownMenuLink js -->
    <script src="./assets/js/nav.js"></script>
    <!-- Popper JS -->
    <script src="./assets/js/popper.min.js"></script>
    <!-- Font Awesome -->
    <script src="./assets/js/all.min.js"></script>

    <!-- End Script Source Files -->
</body>

</html>