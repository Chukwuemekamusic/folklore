

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>PHP Login Form without Session</h1>
    <div class="loginBox">
        <h3>Login Form</h3>
        <br><br>
        <form action="./connection.php" method="post">
            <label>Username</label>
            <input type="text" name="username" placeholder="username">
            <label>password</label>
            <input type="password" name="password" placeholder="password">
            <input type="submit" name="submit" value="login"/>
        </form>
        
    </div>
</body>

</html>