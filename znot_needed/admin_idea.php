<div class="container mt-3">
  <h2>Admin Landing Page</h2>
  <form method="get">
    <div class="form-row align-items-center">
      <div class="col-auto my-1">
        <select class="custom-select mr-sm-2" name="sortby">
          <option value="author">Sort by Author</option>
          <option value="category">Sort by Category</option>
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
    while ($row = $result->fetch_assoc()) {
        $story_id = $row['id'];
        $title = $row['title'];
        $views = $row['views'];
        $author_firstname = ucfirst($row['users.first_name']);
        $author_lastname = ucfirst($row['users.last_name']);
        $author_name = "{$author_firstname} {$author_lastname}";
        $legend = $row['legend_name'];
        $continent = $row['continent'];
        ?>

    <tr>
      <th scope="row"><?php echo $i + 1 ?></th>
      <td><?php echo $story_id ?></td>
      <td><?php echo $title ?></td>
      <td><?php echo $views?></td>
      <td><?php echo $author_name?></td>
      <td><?php echo $legend ?></td>
      <td><?php echo $continent?></td>
      <td>
        <!-- <button type="button" class="btn-sm btn-primary">Edit</button>
        <button type="button" class="btn-sm btn-danger">Delete</button> -->
        <a href="edit_story.php?id=<?php echo $story_id ?>" class="btn btn-primary mr-3">Edit</a>
        <a href="delete_story.php?id=<?php echo $story_id ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this story?')">Delete</a>
      </td> 
    </tr>
  </tbody>
    </table>

    <?php } ?>




<!-- initial idea -->
<ul class="list-group">
            <?php
            $sql = "SELECT stories.id, stories.title, stories.views, stories.image_url, users.first_name, users.last_name
                    FROM stories 
                    INNER JOIN users ON stories.author_id = users.id";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute()) {
            } else {
                echo "Error: " .  $conn->error;
            }
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $story_id = $row['id'];
                $title = $row['title'];
                $views = $row['views'];
                $imagePath = $row['image_url'];
                $author_firstname = $row['first_name'];
                $author_lastname = $row['last_name'];

            ?>
                <li class="list-group-item">
                    <a href="view_story2.php?story_id=<?php echo $story_id; ?>"><?php echo $title; ?></a>
                    <div class="btn-group float-right" role="group">
                        <a href="edit_story.php?id=<?php echo $story_id ?>" class="btn btn-primary mr-3">Edit</a>
                        <a href="delete_story.php?id=<?php echo $story_id ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this story?')">Delete</a>
                    </div>
                    <div class="float-right mr-4 badge badge-primary badge-pill">Views: <?php echo $views; ?></div>
                    <div class="float-right mr-4"><?php echo $author_firstname . ' ' . $author_lastname; ?></div>
                </li>
            <?php 
            }

            ?>
        </ul>