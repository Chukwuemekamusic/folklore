<?php
include_once("connection.php");
if (!isset($_GET['story_id'])) {
    header("Location: storyteller_landing.php");
}
$story_id = $_GET['story_id'];
$sql = "SELECT * FROM stories WHERE id=?";
$stmt = $conn->prepare($sql);
if (!$stmt){
    echo "Error: ". $conn->error;
}
$stmt->bind_param("i", $story_id);
$stmt->execute();
$result = $stmt->get_result();
$story = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Story Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./tutorial/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar bg-light">
        <a class="navbar-brand" href="#">Storyteller</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="storyteller_landing.php">My Stories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_story.php">New Story</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Edit Profile</a>
                </li>
                <li class="nav-item font-weight-bold">
                    <a class="nav-link" href="./webpage.html">Home</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
            <a class="btn btn-danger ml-2" href="./logout.php">Log Out</a>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2><?php echo $story['title']; ?></h2>
                    </div>
                    <div class="card-body">
                        <?php if ($story['image_url']) : ?>
                            <img src="<?php echo $story['image_url'] ?>" class="img-fluid mb-3" alt="<?php echo $story['title']; ?>">
                        <?php endif; ?>
                        <p><?php echo $story['content']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    



    <!-- jQuery -->
    <!-- <script src="./tutorial/js/jquery-3.5.1.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- personal script  -->
    <!-- <script src="./assests/js/sign.js"></script> -->
    <!-- Bootstrap 4.5 JS -->
    <script src="./tutorial/js/bootstrap.min.js"></script>
    <!-- Popper JS -->
    <script src="./tutorial/js/popper.min.js"></script>
    <!-- Font Awesome -->
    <script src="./tutorial/js/all.min.js"></script>
</body>

</html>