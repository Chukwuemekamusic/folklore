<?php
include_once('./connection.php');
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

// check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get form data
    $story_id = mysqli_real_escape_string($conn, $_POST['story_id']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);

    // check that story ID exists in stories table
    $sql = "SELECT id FROM stories WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $story_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (
        $result->num_rows == 0
    ) {
        echo 'id does not exist';
    } else {
        $stmt->close();
        $sql = "INSERT INTO homepage_stories(story_id, position) VALUES (?,?)";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo "Error: " . $conn->error;
            exit;
        }
        // Bind the email parameter to the prepared statement
        $stmt->bind_param("ii", $story_id, $position);


        if ($stmt->execute()) {
            echo 'inserted';
            header("Location: admin_settings.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
            return null;
        }
    }
}



?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Homepage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="admin_dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./admin_landing.php">Stories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./admin_users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./admin_settings.php">Update Homepage</a>
                </li>
                <li class="nav-item font-weight-bold">
                    <a class="nav-link" href="./index.php">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-lg mt-4">
        <h1>Update Homepage Stories</h1>
        <form method="post" action="admin_settings.php">
            <label for="story_id">Story ID:</label>
            <input type="text" name="story_id"><br><br>
            <label for="position">Position:</label>
            <input type="text" name="position"><br>
            <input type="submit" value="Update">
        </form>
    </div>
    <ul class="list-group">
        <?php
        $sortby = isset($_GET['sortby']) ? $_GET['sortby'] : '';
        $sql = "SELECT stories.*, users.first_name, users.last_name, legends.name AS legend_name, continents.name AS continent, homepage_stories.position 
        FROM stories 
        JOIN users ON stories.author_id = users.id 
        JOIN legends ON stories.legend_id = legends.legend_id 
        JOIN continents ON stories.continent_id = continents.continent_id 
        JOIN homepage_stories ON stories.id = homepage_stories.story_id 
        WHERE homepage_stories.position <= 6 
        ORDER BY homepage_stories.position ASC ";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Story id</th>
                    <th>Title</th>
                    <th>Views</th>
                    <th>Storyteller</th>
                    <th>Category/Legend</th>
                    <th>Continent</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $story_id = $row['id'];
                    $title = $row['title'];
                    $views = $row['views'];
                    $author_firstname = ucfirst($row['first_name']);
                    $author_lastname = ucfirst($row['last_name']);
                    $author_name = "{$author_firstname} {$author_lastname}";
                    $legend = $row['legend_name'];
                    $continent = $row['continent'];
                ?>

                    <tr>
                        <th scope="row"><?php echo $i + 1 ?></th>
                        <td><?php echo $story_id ?></td>
                        <a href=""></a>
                        <td><a href="view_story2.php?story_id=<?php echo $story_id; ?>"><?php echo $title ?></a></td>
                        <td><?php echo $views ?></td>
                        <td><?php echo $author_name ?></td>
                        <td><?php echo $legend ?></td>
                        <td><?php echo $continent ?></td>
                    </tr>
                <?php $i++;
                } ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="add_story.php" class="btn btn-primary">Add New Story</a>
        </div>
        <!-- j scripts -->
        <?php include_once('./footer.php') ?>
</body>

</html>