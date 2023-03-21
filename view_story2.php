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
<html>
<head>
	<title>View Story</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="./tutorial/css/style.css"> -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
	<style>
		.card {
			margin-top: 20px;
			border-radius: 0;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}

		.card-header {
			background-color: #f8f9fa;
			border-bottom: 1px solid #dee2e6;
			padding: 10px 15px;
			font-weight: bold;
		}

		.card-body img {
			max-width: 100%;
			height: auto;
			margin-bottom: 10px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<h2 class="mb-0"><?php echo $story['title']; ?></h2>
					</div>
					<div class="card-body">
						<?php if (!empty($story['image_url'])): ?>
							<img src="<?php echo $story['image_url']; ?>" alt="<?php echo $story['title']; ?>">
						<?php endif; ?>
						<p class="card-text"><?php echo $story['content']; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
