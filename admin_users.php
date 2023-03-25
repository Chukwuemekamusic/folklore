<?php 
session_start();
include_once('connection.php');
include_once('functions.php');
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">My Website</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="admin_dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./admin_landing.php">Stories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./admin_users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Settings</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-lg mt-4 p-5">
        <h1 class="mb-4">All Stories on the Site</h1>
    <?php 
        $user_names = get_user_details('*', 'users');
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" data-sortable>#</th>
                <th scope="col" data-sortable>User_id</th>
                <th scope="col" data-sortable>User_name</th>
                <th scope="col" data-sortable>Role</th>
                <th scope="col" data-sortable>Number of stories</th>
                <!-- <th scope="col" data-sortable>total views</th> -->
                <th scope="col" data-sortable><b>Action!</b></th>
            </tr>
        </thead>
        <tbody>


            <?php
            $i = 0;
            foreach ($user_names as $i=>$user) {
                $user_id = ucfirst($user['id']);
                $user_firstname = ucfirst($user['first_name']);
                $user_lastname = ucfirst($user['last_name']);
                $user_name = "{$user_firstname} {$user_lastname}";
                if ($user['is_writer'] == 1) {
                    $role = 'Storyteller';
                    $num_stories = get_num_stories_by_storyteller($user_id) ?? '';
                }else {
                    $role = 'Storyseeker';
                    $num_stories = '';
                }
                // $views = $user['Number_of_stories'];
                // $author_firstname = $user['total_views'];
                
            ?>
                <tr>
                    <th scope="row"><?php echo $i + 1 ?></th>
                    <td><?php echo $user_id?></td>                  
                    <td><?php echo $user_name ?></td>
                    <td><?php echo $role?></td>
                    <td><?php echo $num_stories?></td>
                    
                    <td>
                        
                        <a href="delete_user.php?id=<?php echo $user_id ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</a>
                    </td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
    </div>
</body>

</html>