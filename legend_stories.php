<?php
include('./connection.php');
include_once('./functions.php');
$categories = get_user_details('*', 'legends');

// if(!isset($_GET['category_id'])) {
//     header('Location: index.php');
// }

$legend_id = $_GET['category_id'] ?? '';
if ($legend_id) {
    $legend_stories = get_user_details("*", "stories", "legend_id = $legend_id");
    $legend_details = get_user_details("*", "legends", "legend_id = $legend_id");
    $legend_name = $legend_details[0]['name'];
    $legend_description = $legend_details[0]['description'];
}
$continent_id = $_GET['continent_id'] ?? '';
if ($continent_id) {
    $continent_stories = get_user_details("*", "stories", "continent_id = $continent_id");
    $continent_details = get_user_details("*", "continents", "continent_id = $continent_id");
    // print_r($continent_details);
    // echo $continent_details[0]["name"];
    // exit;
    $continent_name = $continent_details[0]['name'];
    $continent_description = $continent_details[0]['description'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legend Stories</title>
    <!-- Bootstrap 4.5 CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">

</head>

<body>
    <!-- #TODO ADD THE LEGEND TITLE & NAVBAR -->

    <div class="container mt-5">
        <div class="row justify-content-center">
            <?php
            if ($legend_id) { ?>
                <div class="col-md-12 mb-7">
                    <h1 class="display-4 font-weight-bold"><?php echo $legend_name; ?></h1>
                    <p class="lead"><?php echo nl2br($legend_description); ?></p>
                </div>
                <?php
                foreach ($legend_stories as $story) { ?>
                    <div class="col-md-12 mb-4">
                        <div class="card ">
                            <div class="card-header">
                                <h2 class="mb-0"><a href="view_story2.php?story_id=<?php echo $story['id']; ?>"><?php echo ucfirst($story['title']); ?></a></h2>
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
            } elseif ($continent_id) { ?>
                <div class="col-md-12 mb-7">
                    <h1 class="display-4 font-weight-bold"><?php echo $continent_name; ?></h1>
                    <p class="lead"><?php echo nl2br($continent_description); ?></p>
                </div>
                <?php
                foreach ($continent_stories as $story) { ?>
                    <div class="col-md-12 mb-4">
                        <div class="card ">
                            <div class="card-header">
                                <h2 class="mb-0"><a href="view_story2.php?story_id=<?php echo $story['id']; ?>"><?php echo ucfirst($story['title']); ?></a></h2>
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
            }
            ?>
        </div>
</body>

</html>