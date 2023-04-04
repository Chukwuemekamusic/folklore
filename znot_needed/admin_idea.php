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
    $sql = "SELECT stories.*, users.first_name, users.last_name, legends.name AS legend_name 
            FROM stories 
            JOIN users ON stories.author_id = users.id 
            JOIN legends ON stories.legend_id = legends.id
            JOIN continents ON stories.continent_id = continent.id ";
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
        $legend = $row['legend_name']
        ?>

    <tr>
      <th scope="row"><?php echo $i + 1 ?></th>
      <td><?php echo $story_id ?></td>
      <td><?php echo $title ?></td>
      <td><?php echo $views?></td>
      <td><?php echo $author_name?></td>
      <td><?php echo $legend ?></td>
      <td><?php echo $bus['arrival_time']?></td>
      <td><?php echo $bus['bus_capacity']?></td>
      <td><?php echo $bus['seats_booked']?></td>
      <td><?php echo $bus['seats_remaining']?></td>  
      <td><?php echo $bus['bus_number']?></td>
      <td>
        <button type="button" class="btn-sm btn-primary">Edit</button>
        <button type="button" class="btn-sm btn-danger">Delete</button>
      </td>
      
      
    </tr>
    <?php endforeach ?>
