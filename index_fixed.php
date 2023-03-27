<?php
session_start();
include_once('connection.php');
include_once('functions.php');
$categories = get_user_details('*', 'legends');
$continents = get_user_details('*', 'continents');

foreach ($categories as $category) {
  switch ($category['name']) {
      case 'Greek Myths':
          $greekId = $category['legend_id'];
          break;
      case 'Norse Legends':
          $norseId = $category['legend_id'];
          break;
      case 'African Folktales':
          $africanId = $category['legend_id'];
          break;
      case 'Asian Ghost Stories':
          $asianId = $category['legend_id'];
          break;
      case 'South American Myths':
          $southAmericanId = $category['legend_id'];
          break;
      case 'Roman Mythology':
          $romanId = $category['legend_id'];
          break;
      default:
          // handle the case when the category name doesn't match any of the expected values
          break;
  }
 
}
?>
<!DOCTYPE html>
<html lang="en">

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

  <!-- Carousel image -->
  <div id="carousel" class="carousel slide">

    <!--  carousel content -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./assets/img/library_black&white.jpg" alt="" class="w-100">
      </div>

      <div class="carousel-item">
        <img src="./assets/img/library2.jpg" alt="" class="w-100">
      </div>

      <div class="carousel-item">
        <img src="./assets/img/Temple-of-Artemis-Ephesus-POI-7-wonders-ancient.png" alt="" class="w-100">
      </div>

      <div class="carousel-item">
        <img src="./assets/img/library.jpg" alt="" class="w-100">
      </div>
    </div>

    <div class="carousel-caption">
      <div class="container">
        <div class="row justify-content-center">
          <!-- d-none d-lg-block === display none except at lg -->
          <div class="col-10 bg-custom d-none d-lg-block py-3 px-0">
            <h1>Explore the World's Myth and Legends</h1>
            <!-- blue border line underneath it; mx-auto centers it-->
            <div class="border-top border-primary w-50 mx-auto my-3"></div>
            <h3>Discover stories from different cultures and traditions</h3>
            <!-- <a href="#" class="btn btn-danger btn-lg mr-2">View Demo</a>
              <a href="#" class="btn btn-primary btn-lg ml-2">Start Now</a> -->
          </div>
        </div>
      </div>
    </div>
    <!-- End of carousel content -->

    <!-- previous and next button -->
    <a href="#carousel" class="carousel-control-prev" role="button" data-slide="prev">
      <span class="fas fa-chevron-left fa-5x"></span>
    </a>
    <a href="#carousel" class="carousel-control-next" role="button" data-slide="next">
      <span class="fas fa-chevron-right fa-5x"></span>
    </a>
  </div>

  <!-- Featured Story -->

  <div class="row">
    <div class="col text-center mb-5 mt-5">
      <h2>Featured Stories</h2>
      <div class="border-top border-primary w-25 mx-auto my-3"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 mb-4">
      <div class="card h-100 featured-story">
        <img src="./assets/img/epic-gilgamesh.jpg" class="card-img-top w-100" alt="Featured Story" style="height: 300px;">
        <div class="card-body">
          <h5 class="card-title">The Epic of Gilgamesh</h5>
          <p class="card-text">Follow the adventures of the legendary king Gilgamesh as he embarks on a journey to discover the secrets of immortality.</p>
          <a href="#" class="btn btn-primary">Read More</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card h-100 featured-story">
        <img src="./assets/img/Odyssey.jpg" class="card-img-top w-100" alt="Featured Story 2" style="height: 300px;">
        <div class="card-body">
          <h5 class="card-title">The Odyssey</h5>
          <p class="card-text">Join the hero Odysseus as he battles monsters, outwits gods, and struggles to find his way home after the Trojan War.</p>
          <a href="#" class="btn btn-primary">Read More</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card h-100 featured-story">
        <img src="./assets/img/baba_yaga.jpg" class="card-img-top w-100" alt="Featured Story 3" style="height: 300px;">
        <div class="card-body">
          <h5 class="card-title">Baba Yaga</h5>
          <p class="card-text">Discover the strange and magical world of Slavic folklore with the story of Baba Yaga, the infamous witch who lives in a house that walks on chicken legs. Follow the brave and resourceful Vasilisa as she journeys to Baba Yaga's hut to seek her help, but beware: Baba Yaga is known for her unpredictable and dangerous ways.</p>
          <a href="#" class="btn btn-primary">Read More</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card h-100">
        <img src="./assets/img/Charlemagne.jpg" class="card-img-top w-100" alt="Featured Story 4" style="height: 300px;">
        <div class="card-body">
          <h5 class="card-title">Charlemagne </h5>
          <p class="card-text">Charlemagne (known also as Charles the Great, as well as Charles I) was a King of the Franks, the first ruler of the Holy Roman Empire (though the term 'Holy Roman Empire' would only be coined after Charlemagne's death), and one of the most important figures in the history of early Medieval Europe.</p>
          <a href="#" class="btn btn-primary">Read More</a>
        </div>
      </div>
    </div>
    <!-- # TODO  adding of 2 more card -->
    <div class="col-md-4 mb-4">
      <div class="card h-100">
        <img src="./assets/img/Ivan.jpg" class="card-img-top w-100" alt="Featured Story 5" style="height: 300px;">
        <div class="card-body">
          <h5 class="card-title">Ivan Tsarevich, the Firebird, and the Grey Wolf</h5>
          <p class="card-text">Description of the fourth featured story goes here.</p>
          <a href="#" class="btn btn-block">Read More</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card h-100">
        <img src="./assets/img/Nibelungs.jpg" class="card-img-top w-100" alt="Featured Story 6" style="height: 300px;">
        <div class="card-body">
          <h5 class="card-title">The Nibelungenlied</h5>
          <p class="card-text">Enter the world of Germanic mythology and adventure with the story of the Nibelungenlied, a medieval epic that tells the tale of the dragon-slaying hero Siegfried and his doomed love for the beautiful Kriemhild. Filled with knights, dragons, and treachery, this story is a classic of the genre.</p>
          <a href="#" class="btn btn-block">Read More</a>
        </div>
      </div>
    </div>
    <!-- add more col-md-->
  </div>


  <!-- End of featured Story -->


  <!-- Popular Stories -->
  <section id="popular-categories" class="py-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="col text-center mb-3">
          <h2>Popular Categories</h2>
          <div class="border-top border-primary w-25 mx-auto my-3"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="./assets/img/Zeus.jpg" class="card-img-top" alt="Greek Myths">
            <div class="card-body">
              <a href="legend_stories.php?continent_id=<?php echo $greekId?>">
                <h5 class="card-title">Greek Myths</h5>
              </a>
              <p class="card-text">Explore the world of Greek gods, heroes, and monsters through these captivating tales from ancient mythology.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="./assets/img/norse2.jpg" class="card-img-top" alt="Norse Legends">
            <div class="card-body">
              <a href="legend_stories.php?category_id=<?php echo $norseId?>">
                <h5 class="card-title">Norse Legends</h5>
              </a>
              <p class="card-text">Discover the stories of the mighty gods, fierce warriors, and fantastical creatures of Norse mythology.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="./assets/img/yoruba3.jpg" class="card-img-top" alt="African Folktales">
            <div class="card-body">
              <a href="legend_stories.php?category_id=<?php echo $africanId?>">
                <h5 class="card-title">African Folktales</h5>
              </a>
              <p class="card-text">Journey through the rich cultural heritage of Africa with these vibrant tales passed down from generation to generation.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="./assets/img/asian.png" class="card-img-top" alt="Asian Ghost Stories">
            <div class="card-body">
              <a href="legend_stories.php?category_id=<?php echo $asianId?>">
                <h5 class="card-title">Asian Ghost Stories</h5>
              </a>
              <p class="card-text">Experience the spine-chilling thrill of Asian ghost stories, filled with vengeful spirits, haunted places, and ancient curses.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="./assets/img/inca.jpg" class="card-img-top" alt="South American Myths">
            <div class="card-body">
              <a href="legend_stories.php?category_id=<?php echo $southAmericanId?>">
                <h5 class="card-title">South American Myths</h5>
              </a>
              <p class="card-text">Delve into the mystical world of South American mythology, featuring powerful deities, legendary heroes, and magical creatures.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="./assets/img/rome.jpg" class="card-img-top" alt="South American Myths">
            <div class="card-body">
              <a href="legend_stories.php?category_id=<?php echo $romanId?>">
                <h5 class="card-title">Roman Mythology</h5>
              </a>
              <p class="card-text">Discover the captivating tales of Roman mythology, filled with powerful gods and goddesses, epic battles, and thrilling adventures that will transport you to ancient times.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End of Popular Stories -->

  </main>

  <div class="container my-5"></div>



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