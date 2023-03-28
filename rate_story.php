<?php
session_start();
include_once('./connection.php');
include_once('./functions.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID from the session (you can modify this based on your authentication system)
    $user_id = $_SESSION['user_id'];
    $story_id = $_POST['story_id'];
    $rating = $_POST['rating'];

    // Get the comment from the form submission
    $comment = $_POST['comment'] ?? '';

    // Insert the rating into the database
    $stmt = $conn->prepare('REPLACE INTO story_ratings (story_id, user_id, rating, comment) VALUES (?, ?, ?, ?)');
    $stmt->bind_param("iids", $story_id, $user_id, $rating, $comment);
    if ($stmt->execute()) {
        echo 'success';
        $stmt->close();
        // header('Location: story.php?id=' . $story_id);

        // Calculate the average rating for the story
        $sql = "SELECT AVG(rating) AS avg_rating FROM story_ratings WHERE story_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $story_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $avg_rating = round($row['avg_rating'], 1);

        // Update the rating column in the stories table
        $sql = "UPDATE stories SET rating = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "di", $avg_rating, $story_id);
        if (mysqli_stmt_execute($stmt)) {
            echo 'success';
        } else {
            echo 'failed';
        }
    } else {
        echo 'failed';
    }
    $stmt->close();
}
