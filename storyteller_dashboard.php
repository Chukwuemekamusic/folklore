<?php 
    session_start();
    $user_id = $_SESSION['user_id'];
    $firstname = $_SESSION['first_name'];

    include_once('connection.php');
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storyteller Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./tutorial/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">

</head>

<body>
    
    <!-- #TODO rename navbar -->
    <nav class="navbar bg-light navbar-light navbar-expand-lg">
        <div class="container">
            <a href="" class="navbar-brand">logo</a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navbarResponsive" class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="webpage.html" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Explore</a></li>
                <li class="nav-item"><a href="login.html" class="nav-link active">Login/Sign-up</a></li>
                <li class="nav-item"><a href="#" class="nav-link">My Stories</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
    <div class="row">
      <div class="col-md-8">
        <h2 class="mb-4">My Stories</h2>
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">Story Title</h5>
              <small>3 days ago</small>
            </div>
            <p class="mb-1">Story Description</p>
            <small>Tags: Tag1, Tag2, Tag3</small>
          </a>

</body>

</html>