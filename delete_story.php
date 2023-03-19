<? 
include_once('connection.php');
if(isset($_GET['id'])) {
$story_id = $_GET['id'];

$sql = "DELETE FROM stories WHERE id =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $story_id);
$stmt->execute();

header('Location: storyteller_landing.php');
exit;
}else {
    header('Location: storyteller_landing.php');
}