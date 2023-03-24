<?php 
include_once('connection.php');
// if(isset($_GET['id'])) {
// $story_id = $_GET['id'];

// $sql = "DELETE FROM stories WHERE id =?";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("i", $story_id);
// $stmt->execute();

// header('Location: storyteller_landing.php');
// exit;
// }else {
//     header('Location: storyteller_landing.php');
// }

// Store previous page URL in session variable
if(isset($_SERVER['HTTP_REFERER'])){
    session_start();
    $_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'];
}

if(isset($_GET['id'])) {
    $story_id = $_GET['id'];

    $sql = "DELETE FROM stories WHERE id =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $story_id);
    $stmt->execute();

    // Redirect to previous page URL stored in session variable
    if(isset($_SESSION['previous_page'])){
        header('Location: ' . $_SESSION['previous_page']);
        unset($_SESSION['previous_page']);
    } else {
        header('Location: storyteller_landing.php');
    }
    exit;
} else {
    header('Location: ' . $_SESSION['previous_page']);
    unset($_SESSION['previous_page']);
}
?>