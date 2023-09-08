<?php
session_start();
include('./connection.php');
include_once('./functions.php');
$stories = get_user_details('*', 'stories');
$search_query = $_POST['search-input'] ?? '';
if ($search_query){
    $search_stories = searchStories($search_query);
}
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
    <?php include_once('./navbar.php') ?>
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
   <?php include_once('./footer.php'); ?>

    <!-- End Script Source Files -->
</body>

</html>