<?php
include_once('connection.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
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

// Get top rated stories
$top_stories = get_top_rated_stories(5);

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
    <!-- Navbar starts-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin</a>
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
                    <a class="nav-link" href="settings.php">Settings</a>
                </li>
                <li class="nav-item font-weight-bold">
                    <a class="nav-link" href="./index.php">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Navbar ends -->

    <div class="container-lg mt-4 p-5">
        <div class="col text-center">
            <h1>Admin Dashboard</h1>
            <div class="border-top border-primary w-25 mx-auto my-3"></div>
        </div>
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
                            <table>
                                <thead>
                                    <tr>

                                        <th scope="col" data-sortable>Story id</th>
                                        <th scope="col" data-sortable>Title</th>
                                        <th scope="col" data-sortable>Views</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($popular_stories as $i => $story) { ?>
                                        <tr>

                                            <td><?php echo $story['id'] ?></td>
                                            <a href=""></a>
                                            <td><a href="view_story2.php?story_id=<?php echo $story['id']; ?>"><?php echo $story['title']; ?></a></td>
                                            <td><?php echo $story['views']; ?></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Top Rated Stories</h5>
                        <div class="card-text">
                            <table>
                                <thead>
                                    <tr>

                                        <th scope="col" data-sortable>Story id</th>
                                        <th scope="col" data-sortable>Title</th>
                                        <th scope="col" data-sortable>Rating</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($top_stories as $i => $story) { ?>
                                        <tr>

                                            <td><?php echo $story['id'] ?></td>
                                            <a href=""></a>
                                            <td><a href="view_story2.php?story_id=<?php echo $story['id']; ?>"><?php echo $story['title']; ?></a></td>
                                            <td><?php echo $story['rating']; ?></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- js scripts -->
    <?php include_once('./footer.php'); ?>
</body>

</html>