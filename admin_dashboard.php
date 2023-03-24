<?php
include_once('connection.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
}
include_once('functions.php');


// Calculate total number of stories and storytellers
$num_stories = get_num_rows('stories');
$num_storytellers = get_num_rows('users', 'is_writer = 1');

// Calculate number of new users in the last X days
$num_new_users = get_num_rows('users', 'created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)');

// Calculate number of stories published per day/week/month
$num_stories_day = get_num_rows('stories', 'created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY)');
$num_stories_week = get_num_rows('stories', 'created_at >= DATE_SUB(NOW(), INTERVAL 1 WEEK)');
$num_stories_month = get_num_rows('stories', 'created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)');

// Get most popular stories
$popular_stories = get_popular_stories(5);

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">My Website</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link active" href="admin_dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./admin_landing.php">Stories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./admin_users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Settings</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-lg mt-5 p-5">
        <h1>Admin Dashboard</h1>
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Number of Stories</h5>
                        <p class="card-text"><?php echo $num_stories; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Number of Storytellers</h5>
                        <p class="card-text"><?php echo $num_storytellers; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Number of Stories Published (Yesterday)</h5>
                        <p class="card-text"><?php echo $num_stories_day; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Number of Stories Published (Last Week)</h5>
                        <p class="card-text"><?php echo $num_stories_week; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Number of Stories Published (Last Month)</h5>
                        <p class="card-text"><?php echo $num_stories_month; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Most Popular Stories</h5>
                        <div class="card-text">
                            <ul>
                                <?php foreach ($popular_stories as $story) { ?>
                                    <li> <?php echo $story['title']; ?> (Views: <?php echo $story['views']; ?>)</li>
                                <?php } ?>
                        </div>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>