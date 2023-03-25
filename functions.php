<?php
include_once('./connection.php');

// get total no of rows in a table
function get_num_rows($table, $condition = '')
{
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
        if ($stmt->execute()) {
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
function get_num_new_users($days)
{
    $condition = "created_at >= DATE_SUB(NOW(), INTERVAL $days DAY)";
    return get_num_rows('users', $condition);
}

// Calculate number of stories published per day/week/month
function get_num_stories_published($interval)
{
    $condition = "created_at >= DATE_SUB(NOW(), INTERVAL $interval)";
    return get_num_rows('stories', $condition);
}

// get most popular stories
function get_popular_stories($limit)
{
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

function get_user_details($details, $table, $condition = '', $order_by = '')
{
    global $conn;
    $sql = "SELECT $details FROM $table";
    if ($condition !== '') {
        $sql .= " WHERE $condition";
    }
    if ($order_by !== '') {
        $sql .= " ORDER BY $order_by";
    }
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // handle the error
        echo 'statement failed!!!';
        echo "Error: " . $conn->error;
        return null;
    } else {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "Error: " . $conn->error;
            return null;
        }
    }
}

function get_num_stories_by_storyteller($storyteller_id)
{
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
        if ($stmt->execute()) {
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
function searchStories($search_query)
{
    global $conn;
    // prepare SQL statement
    $sql = "SELECT DISTINCT stories.*, legends.name AS legend_name, continents.name AS continent_name
            FROM stories
            LEFT JOIN legends ON stories.legend_id = legends.legend_id
            LEFT JOIN continents ON stories.continent_id = continents.continent_id
            LEFT JOIN story_tag ON stories.id = story_tag.story_id
            LEFT JOIN tags ON story_tag.tag_id = tags.tag_id
            WHERE stories.title LIKE ?
            OR stories.description LIKE ?
            OR stories.content LIKE ?
            OR legends.name LIKE ?
            OR continents.name LIKE ?
            OR tags.name LIKE ?
            ORDER BY stories.created_at DESC";

    // prepare statement
    $stmt = mysqli_prepare($conn, $sql);

    // bind parameters
    $search_query = "%{$search_query}%";
    mysqli_stmt_bind_param($stmt, "ssssss", $search_query, $search_query, $search_query, $search_query, $search_query, $search_query);

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

#TODO work on update views
function update_story_views($story_id) //only updates views when the viewer is not the author
{
    global $conn;

    
    $is_authorized = true;
    // Check if the user is the author of the story
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT author_id FROM stories WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $story_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row && $row['author_id'] == $user_id) {
            // The user is authorized to update views
            $is_authorized = false;
        }
    }
    if (!$is_authorized ) {  
        // && !isset($_SESSION['admin'])
        return;
    }

    // Update the story views
    $sql = "UPDATE stories SET views=views+1 WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $story_id);
    $stmt->execute();
}

// create random string no
function randomStr($n=8) {        //Stephen watkins https://stackoverflow.com/questions/4356289/php-random-string-generator
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $n; $i++) {
          $randomString .= $characters[random_int(0, $charactersLength - 1)];
      }
      return $randomString;
  }

// handle upload image
function handle_image_upload($image, $current_image_path = '') {
    global $conn;
    $imagePath = '';
  
    if (!is_dir('./images')) {
      if (mkdir('images', 511)){
        echo "successful creation of image folder! <br>";
      } else {
        echo "Error: " . $conn->error;
      }
    }
    $allowedTypes = array("jpg", "jpeg", "png", "gif");
  
    if ($image && $image['tmp_name']) {
      if ($image['error'] === 0) {
        $imageExt = strtolower(end(explode('.', $image['name'])));
        
        if (in_array($imageExt, $allowedTypes)){
          $imagePath = 'images/'.randomStr().'/'.$image['name'];
          mkdir(dirname($imagePath));
          move_uploaded_file($image['tmp_name'], $imagePath);
        } else {
          echo 'Wrong file extension format!!! <br>';
        }
      } else {
        echo 'Error uploading Image!';
      }
    } else {
        // If the file input is empty, return the current image URL
        $imagePath = $current_image_path;
      }
  
    return $imagePath;
  }