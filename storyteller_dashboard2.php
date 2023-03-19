<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Storyteller Profile</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-RJjoOOa1nL+hr3qK/D5h5xV7Xd/5+IKuV7lH9XhmnDXfjKb7gDH1mCvH8mGKBlCn1e2z9X4v4Aq3UaKgeEJNog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Storyteller Profile</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">My Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Logout</a>
        </li>
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
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">Story Title</h5>
              <small>5 days ago</small>
            </div>
            <p class="mb-1">Story Description</p>
            <small>Tags: Tag1, Tag2, Tag3</small>
          </a>
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">Story Title
                <div class="container mt-5">
                  <div class="row">
                    <div class="col-md-8">
                      <h2>My Stories</h2>
                      <hr>
                      <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Story 1
                          <span class="badge badge-primary badge-pill">10 views</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Story 2
                          <span class="badge badge-primary badge-pill">20 views</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Story 3
                          <span class="badge badge-primary badge-pill">5 views</span>
                        </li>
                        <!-- add more stories dynamically using JavaScript -->
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h2>Add New Story</h2>
                      <hr>
                      <form>
                        <div class="form-group">
                          <label for="story-title">Title</label>
                          <input type="text" class="form-control" id="story-title" required>
                        </div>
                        <div class="form-group">
                          <label for="story-body">Body</label>
                          <textarea class="form-control" id="story-body" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Add Story</button>
                      </form>
                    </div>
                  </div>
                </div>