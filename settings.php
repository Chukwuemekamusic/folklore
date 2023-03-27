<?php
include_once('connection.php');
ob_start();
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
include_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit']) && $_POST['submit'] == 'edit_category') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $id = $_POST['id'];
        $image = $_FILES['image'];

        // Call edit_category function
        $result = edit_category($id, $name, $description, $image);

        // Check result
        if ($result) {
            echo "Category updated successfully.";
            header("Location: settings.php");
            exit();
        } else {
            echo "Error updating category.";
        }
       
    } else {
        $name = $_POST['category_name'];
        $description = $_POST['category_description'];


        // Handle image upload
        if ($_FILES['category_image']['name']) {
            $image_url = handle_image_upload($_FILES['category_image']);
        } else {
            $image_url = '';
        }

        $sql = "INSERT INTO legends (name, description, image_url) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $description, $image_url);
        if ($stmt->execute()) {
            echo "<h3> category inserted! </h3> <br>";
            header("Location: settings.php");
            exit();
        } else {
            echo "<h4 Failed Insertion! </h4> <br>";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <!-- Navbar starts-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="admin_dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./admin_landing.php">Stories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./admin_users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="settings.php">Settings</a>
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
    </header>
    <div class="container-lg mt-4 p-5">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $categories = get_user_details('*', 'legends');
                foreach ($categories as $category) { ?>
                    <tr>
                        <td><?php echo $category['name']; ?></td>
                        <td><?php echo $category['description']; ?></td>
                        <td><img src="<?php echo $category['image_url']; ?>" width='100'></td>
                        <td><a href="?action=edit&id=<?php echo $category['legend_id']; ?>">Edit</a></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>

        <hr>
        <?php
        if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $category = get_user_details("*", "legends", "legend_id = $id")[0];
        ?>
            <div class="col text-center mt-4">
                <h3 class="mb-4">Edit Category</h3>
                <div class="border-top border-primary w-25 mx-auto my-3"></div>
            </div>
            <div class="form-group">
                <form method="post" enctype="multipart/form-data" action="settings.php?action=update&id=<?php echo $category['legend_id']; ?>">
                    <input class='form-control' type="hidden" name="id" value="<?php echo $category['legend_id'] ?>">
                    <div>
                        <label for="name">Category Name</label>
                        <input class='form-control' type="text" name="name" value="<?php echo $category['name'] ?>" required>
                    </div>
                    <div>
                        <label for="description">Category Description</label>
                        <textarea class='form-control' name="description" required><?php echo $category['description'] ?></textarea>
                    </div>
                    <div>
                        <label for="image">Image</label>
                        <input class='form-control' type="file" name="image">
                        <?php if ($category['image_url']) { ?>
                            <img src="<?php echo $category['image_url'] ?>" width="100">
                        <?php } ?>
                    </div>
                    <button type="submit" name="submit" value="edit_category">Save Changes</button>
                </form>
            <?php } ?>
            </div>
        <hr>
        <div class="col text-center mt-4">
            <h3 class="mb-4">Add new Category</h3>
            <div class="border-top border-primary w-25 mx-auto my-3"></div>
        </div>
        <form method="POST" enctype="multipart/form-data" action="admin_dashboard.php">
            <div class="form-group">
                <label for="category_name">Category Name:</label>
                <input class='form-control' type="text" name="category_name" id="category_name" required>

                <label for="category_description">Category Description:</label>
                <textarea class='form-control' name="category_description" id="category_description" required></textarea>

                <label for="category_image">Category Image:</label>
                <input class='form-control' type="file" name="category_image" id="category_image">

                <button type="submit">Add Category</button>
            </div>
        </form>
        <hr>
            <?php include_once('./footer.php'); 
            ob_end_flush();?>
</body>

</html>