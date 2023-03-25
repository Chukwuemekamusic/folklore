<?php
include_once('connection.php');
include_once('functions.php');
$categories = get_user_details('*', 'legends');
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Folktales & Myths</title>
    <!-- Bootstrap 4.5 CSS -->
    <!-- <link rel="stylesheet" href="./assets/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
</head>

<body>

    <div class="container py-5">
        <h1 class="mb-4">Multilevel Dropdown</h1>
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> Menu </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li class="dropdown dropend">
                    <a class="dropdown-item dropdown-toggle" href="#" id="multilevelDropdownMenu1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Multilevel Action 1</a>
                    <ul class="dropdown-menu" aria-labelledby="multilevelDropdownMenu1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li class="dropdown dropend">
                            <a class="dropdown-item dropdown-toggle" href="#" id="multilevelDropdownMenu1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Multilevel Action 2</a>
                            <ul class="dropdown-menu" aria-labelledby="multilevelDropdownMenu2">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
    </div>
    <!-- Script Source Files -->

    <!-- jQuery -->
    <script src="./assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap 4.5 JS -->
    <script src="./assets/js/bootstrap.min.js"></script>
    <script>
        let dropdowns = document.querySelectorAll('.dropdown-toggle')
        dropdowns.forEach((dd) => {
            dd.addEventListener('click', function(e) {
                var el = this.nextElementSibling
                el.style.display = el.style.display === 'block' ? 'none' : 'block'
            })
        })
    </script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <script src="./assets/js/all.min.js"></script>

    <!-- End Script Source Files -->
</body>

</html>