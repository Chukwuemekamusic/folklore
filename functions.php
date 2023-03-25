<?php
include_once('./connection.php');

// get total no of rows in a table
function get_num_rows($table, $condition = '') {
    global $conn;
    $sql = "SELECT COUNT(*) AS count FROM $table";
    if ($condition !== '') {
        $sql .= " WHERE $condition";
    }
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // handle the error
        echo 'statement failed!!!';
        echo "Error: " . $conn->error;
        return null;
    } else {
        if($stmt->execute()){
            $stmt->bind_result($count);
            $stmt->fetch();
            return $count;
        
        } else {
            echo "Error: " . $conn->error;
            return null; 
        }
    }
}

// Calculate number of new users in the last X days
function get_num_new_users($days) {
    $condition = "created_at >= DATE_SUB(NOW(), INTERVAL $days DAY)";
    return get_num_rows('users', $condition);
}

// Calculate number of stories published per day/week/month
function get_num_stories_published($interval) {
    $condition = "created_at >= DATE_SUB(NOW(), INTERVAL $interval)";
    return get_num_rows('stories', $condition);
}

// get most popular stories
function get_popular_stories($limit) {
    global $conn;
    $sql = "SELECT id, title, views FROM stories
            ORDER BY views DESC
            LIMIT $limit";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $conn->error;
        return null;
    } else {
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

function get_user_details($details, $table, $condition='') {
    global $conn;
    $sql = "SELECT $details FROM $table";
    if ($condition !== '') {
        $sql .= " WHERE $condition";
    }
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // handle the error
        echo 'statement failed!!!';
        echo "Error: " . $conn->error;
        return null;
    } else {
        if($stmt->execute()){
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);        
        } else {
            echo "Error: " . $conn->error;
            return null; 
        }
    }
}

function get_num_stories_by_storyteller($storyteller_id) {
    global $conn;
    $sql = "SELECT COUNT(*) FROM stories WHERE author_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
      // handle the error
      echo 'statement failed!!!';
      echo "Error: " . $conn->error;
      return null;
    } else {
      $stmt->bind_param("i", $storyteller_id);
      if($stmt->execute()){
            $stmt->bind_result($count);
            $stmt->fetch();
            return $count;
      } else {
          echo "Error: " . $conn->error;
          return null; 
      }
    }
  }

  // Search function for stories
  function searchStories($search_query) {
    global $conn;
    // prepare SQL statement
    $sql = "SELECT stories.*, legends.name AS legend_name, continents.name AS continent_name
            FROM stories
            LEFT JOIN legends ON stories.legend_id = legends.legend_id
            LEFT JOIN continents ON stories.continent_id = continents.continent_id
            WHERE stories.title LIKE ?
            OR stories.description LIKE ?
            OR stories.content LIKE ?
            OR legends.name LIKE ?
            OR continents.name LIKE ?
            ORDER BY stories.created_at DESC";
  
    // prepare statement
    $stmt = mysqli_prepare($conn, $sql);
  
    // bind parameters
    $search_query = "%{$search_query}%";
    mysqli_stmt_bind_param($stmt, "sssss", $search_query, $search_query, $search_query, $search_query, $search_query);
  
    // execute statement
    if (mysqli_stmt_execute($stmt)) {
     
        $result = mysqli_stmt_get_result($stmt);  
        mysqli_stmt_close($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
        
    } else {
      echo "Error: " . $conn->error;
      return null; 
  }    
    // mysqli_close($conn); 
  }

?>

<!-- 
// include_once('connection.php');

// // Get total number of stories and storytellers
// $sql_total_stories = "SELECT COUNT(*) AS total_stories FROM stories";
// $result_total_stories = $conn->query($sql_total_stories);
// $row_total_stories = $result_total_stories->fetch_assoc();
// $total_stories = $row_total_stories['total_stories'];

// $sql_total_storytellers = "SELECT COUNT(DISTINCT author_id) AS total_storytellers FROM stories";
// $result_total_storytellers = $conn->query($sql_total_storytellers);
// $row_total_storytellers = $result_total_storytellers->fetch_assoc();
// $total_storytellers = $row_total_storytellers['total_storytellers'];

// // Get number of new users in the last X days (set X to 30 for example)
// $days = 30;
// $date = date('Y-m-d', strtotime("-$days days"));
// $sql_new_users = "SELECT COUNT(*) AS new_users FROM users WHERE created_at >= '$date'";
// $result_new_users = $conn->query($sql_new_users);
// $row_new_users = $result_new_users->fetch_assoc();
// $new_users = $row_new_users['new_users'];

// // Get number of stories published per day/week/month
// $sql_stories_by_day = "SELECT COUNT(*) AS total_stories, DATE(created_at) AS created_day FROM stories -->