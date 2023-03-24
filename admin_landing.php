<?php
session_start();

include('connection.php');
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">My Website</a>
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

    <div class="container-lg mt-4 p-5">
        <h1 class="mb-4">All Stories on the Site</h1>
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
                        <!-- <th scope="col" data-sortable>Description</th> -->
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
                            <td><a href="view_story2.php?story_id=<?php echo $story_id;?>"><?php echo $title ?></a></td>
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

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT"></script>
</body>

</html>;

<!-- $sort_by = $_GET['sort-by'];
switch ($sort_by) {
  case 'author-name':
    $sql = "SELECT s.*, u.firstname, u.lastname FROM stories s JOIN users u ON s.author_id = u.id ORDER BY u.lastname, u.firstname";
    break;
  case 'category':
    $sql = "SELECT s.*, c.name as category_name FROM stories s JOIN categories c ON s -->

<!-- 
    <form method="get" action="">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label class="sr-only" for="sort-by">Sort by</label>
                    <select class="form-control mb-2" id="sort-by" name="sort-by">
                        <option value="author-name" <?php if ($_GET['sort-by'] == 'author-name') echo 'selected'; ?>>Author name</option>
                        <option value="category" <?php if ($_GET['sort-by'] == 'category') echo 'selected'; ?>>Category</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-2">Sort</button>
                </div>
            </div>
        </form> -->