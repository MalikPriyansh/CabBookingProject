<?php
require_once "config.php";
$name_error="";
$password_error="";
$confirm_error="";
$mobile_error="";

$match="";
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
    if(empty(trim($_POST["confirm-password"])))
    {
        $confirm_error = "Confirm Password can not be empty";
    }
    if(trim($_POST["password"])!==trim($_POST["confirm-password"]))
    {
        $match= "Passwords should match";
    }
    if(empty(trim($_POST["mobile"])))
    {
        $mobile_error="Enter Mobile Number";
    }
    if(empty($name_error) && empty($password_error) && empty($confirm_error) && empty($match) && empty($mobile_error))
    {
        $name=$_POST["name"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $mobile=$_POST["mobile"];
        $sql = "INSERT INTO users (username , password , Mobile) VALUES ('$name' , '$password' , '$mobile')";
        $result = mysqli_query($conn,$sql);
        if($result==false)
        {
            echo "Something Went Wrong!";
        }
        else
        {
            header("location: blabla.php");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        <h1 style="color: #203239;">Please Register</h1>
        <form action="" method="post">
            <input type="text" class="input" name="name" placeholder="Username"><br>
            <?php
             if(empty($name_error)==false)
              { echo $name_error; echo "<br>";} ?>
            <input type="password" class="input" name="password" placeholder="Password" ><br>
            <?php
             if(empty($password_error)==false)
              { echo $password_error; echo"<br>";} ?>
              <?php if(empty($match)==false)
              { echo $match; echo "<br>";} ?>
            <input type="password" class="input" name="confirm-password" placeholder="Confirm Password"><br>
            <?php
             if(empty($confirm_error)==false)
              { echo $confirm_error; echo"<br>";} ?>
            <input type="tel" class="input" name="mobile" placeholder="Mobile Number" pattern="[0-9]{10}"><br>
            <?php
             if(empty($mobile_error)==false)
              { echo $mobile_error; echo"<br>";} ?>
            <input type="submit" class="input btn-primary" value="Book" name="submit"><br>
        </form>
    </div>
</body>
</html>