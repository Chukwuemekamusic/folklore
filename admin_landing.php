<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

include('./connection.php');
include('./functions.php');
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
        $sql = "INSERT INTO homepage_stories(story_id, position) VALUES (?,?) ON DUPLICATE KEY UPDATE story_id= ?";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo "Error: " . $conn->error;
            exit;
        }
        // Bind the email parameter to the prepared statement
        $stmt->bind_param("iii", $story_id, $position, $story_id);


        if ($stmt->execute()) {
            header("Location: admin_landing.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
            return null;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Storyteller Landing Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./tutorial/css/style.css">
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
                <li class="nav-item active">
                    <a class="nav-link" href="admin_dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./admin_landing.php">Stories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./admin_users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./settings.php">Settings</a>
                </li>
                <li class="nav-item font-weight-bold">
                    <a class="nav-link" href="./index.php">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-lg mt-4 p-5">
        <div class="col text-center">
            <h1 class="mb-4">All Stories on the Site</h1>
            <div class="border-top border-primary w-25 mx-auto my-3"></div>
        </div>
        <form method="get">
            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                    <select class="custom-select mr-sm-2" name="sortby">
                        <!-- #TODO make the option selected to remain; -->
                        <!-- #TODO create function that increases view count; -->
                        <option value="author">Sort by Author</option>
                        <option value="category">Sort by Category</option>
                        <option value="earliest">Sort by Earliest</option>
                        <option value="latest">Sort by Latest</option>
                    </select>
                </div>
                <div class="col-auto my-1">
                    <button type="submit" class="btn btn-primary">Sort</button>
                </div>
            </div>
        </form>
        <hr>
        <ul class="list-group">
            <?php
            $sortby = isset($_GET['sortby']) ? $_GET['sortby'] : '';
            $sql = "SELECT stories.*, users.first_name, users.last_name, legends.name AS legend_name, continents.name AS continent 
            FROM stories 
            JOIN users ON stories.author_id = users.id 
            JOIN legends ON stories.legend_id = legends.legend_id
            JOIN continents ON stories.continent_id = continents.continent_id ";
            if ($sortby == 'author') {
                $sql .= "ORDER BY users.last_name, users.first_name";
            } elseif ($sortby == 'category') {
                $sql .= "ORDER BY legends.name";
            } elseif ($sortby == 'earliest') {
                $sql .= "ORDER BY created_at";
            } elseif ($sortby == 'latest') {
                $sql .= "ORDER BY `created_at` DESC";
            }
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" data-sortable>#</th>
                        <th scope="col" data-sortable>Story id</th>
                        <th scope="col" data-sortable>Title</th>
                        <th scope="col" data-sortable>Views</th>
                        <th scope="col" data-sortable>Storyteller</th>
                        <th scope="col" data-sortable>Category/Legend</th>
                        <th scope="col" data-sortable>Continent</th>
                        <th scope="col" data-sortable><b>Action!</b></th>
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
                            <td>
                                <!-- <button type="button" class="btn-sm btn-primary">Edit</button>
        <button type="button" class="btn-sm btn-danger">Delete</button> -->
                                <a href="admin_edit_story.php?id=<?php echo $story_id ?>" class="btn btn-primary mr-3">Edit</a>
                                <a href="delete_story.php?id=<?php echo $story_id ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this story?')">Delete</a>
                            </td>
                        </tr>

                    <?php $i++;
                    } ?>
                </tbody>
            </table>

            <div class="text-center mt-4">
                <a href="add_story.php" class="btn btn-primary">Add New Story</a>
            </div>
    </div>
    <div class="container-lg mt-4">
        <div class="col text-center">
            <h2 class="mb-4">All Stories on Homepage</h2>
            <div class="border-top border-primary w-25 mx-auto my-3"></div>
        </div>
        <h4>Update Homepage Stories</h4>
        <form method="post">
            <label for="story_id">Story ID:</label>
            <input type="text" name="story_id"><br><br>
            <label for="position">Position:</label>
            <input type="text" name="position"><br>
            <input type="submit" value="Update">
        </form>
    </div>
    <ul class="list-group">
        <?php
        $homepageStories = getHomepageStories();
        ?>
        <table class="table table-striped mb-5">
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
                foreach ($homepageStories as $row) {
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

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT"></script>
</body>

</html>;
