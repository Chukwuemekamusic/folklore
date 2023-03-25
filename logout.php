<?php
    session_start();
    // ob_start();
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
    // ob_end_flush();
    exit();


// function logout($user_type = '') {
//   // If $user_type is not specified or empty, check if it is admin or storyteller
//   if(empty($user_type)) {
//     if(isset($_SESSION['user_id'])) {
//       $user_type = 'storyteller';
//     } elseif(isset($_SESSION['admin_id'])) {
//       $user_type = 'admin';
//     }
//   }

//   // Perform logout based on user type
//   switch ($user_type) {
//     case 'storyteller':
//       // Perform logout for storyteller
//       session_unset();
//       session_destroy();
//       header("Location: index.php");
//       break;
//     case 'admin':
//       // Perform logout for admin
//       session_unset();
//       session_destroy();
//       header("Location: admin_login.html");
//       break;
//     default:
//       // Invalid user type
//       echo "Invalid user type";
//   }
// }
?>

