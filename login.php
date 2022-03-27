<?php
require_once "config.php";
$name_error="";
$password_error="";
$_SESSION['loggedin'] = false;
if($_SERVER['REQUEST_METHOD']=="POST")
{
    if(empty(trim($_POST["name"])))
    {
        $name_error= "Name can not be empty";
    }
    if(empty(trim($_POST["password"])))
    {
        $password_error= "Password can not be empty";
    }
    $name=trim($_POST['name']);
    echo $name;
    $password=trim($_POST['password']);
    echo $password;
    if(empty($name_error) && empty($password_error))
    {
        $sql = "SELECT * FROM `users`";
        $result = mysqli_query($conn, $sql);
        $row="";
        $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        while($row=mysqli_fetch_assoc($result))
        {
            if($row['username']==$name)
            {
                if(password_verify($password, $hashed_password))
                {
                    session_start();
                    $_SESSION["loggedin"] = true;
                    header("location: booking.php");
                }
            }
        }
        $ans="";
        $ans= "We have not found you in our database";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="nav">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark nav">
            <a class="navbar-brand text" href="#">Graphic Cab</a>
        </nav>
    </div>
    <div class="book">
        <h1 style="color: #203239;">Please Login </h1>
        <form action="" method="post">
            <input type="text" class="input" name="name" placeholder="Username"><br>
            <?php
             if(empty($name_error)==false)
              { echo $name_error; echo "<br>";} ?>
            <input type="password" class="input" name="password" placeholder="Password" ><br>
            <?php
             if(empty($password_error)==false)
              { echo $password_error; echo"<br>";} ?>
            <input type="submit" class="input btn-primary" value="Sign in" name="submit"><br>
            <a href="register.php">Create An Account</a><br>
            <?php
             if(empty($ans)==false)
              { echo $ans; echo"<br>";} ?>
        </form>
    </div>
</body>
</html>