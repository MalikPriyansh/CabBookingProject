<?php
require_once "config.php";
session_start();

    
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
    {
        header("location: login.php");
        exit;
    }
    $in = $des = $dt = $cn ="";
    $ans="";
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if(empty(trim($_POST["initial"])))
        {
            $in="Initial must contain a place name";
        }
        if(empty(trim($_POST["destination"])))
        {
            $des = "Destination must contain a place name";
        }
        if(empty($_POST["carno"]))
        {
            $cn = "Car Number must be there";
        }
        if(empty($_POST["date"]))
        {
            $dt="Date must be entered";
        }
        if(empty($in) && empty($des) && empty($dt) && empty($cn))
        {
            echo "Entered";
            $initial = $_POST['initial'];
            echo $initial;
            $destination = $_POST['destination'];
            echo $destination;
            $car = $_POST['carno'];
            echo $car;
            $date = $_POST['date'];
            echo $date;
            $sql = "INSERT INTO `booking` (`initial`, `destination`, `car_no.`, `date`) VALUES ('$initial', '$destination', '$car', '$date');";
            $result = mysqli_query($conn,$sql);
            if($result==false)
            {
                echo "Something Went Wrong!";
            }
            for($i=1;$i<=5;$i++)
            {
                $initial = $_POST['initial'.$i];
                if(empty($initial)==false)
                {
                    $sql = "INSERT INTO `booking` (`initial`, `destination`, `car_no.`, `date`) VALUES ('$initial', '$destination', '$car', '$date');";
                    $result = mysqli_query($conn,$sql);
                    if($result==false)
                    {
                        echo "Something Went Wrong!";
                        break;
                    }
                }
            }
            $ans = "Ride has been offered";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer A Ride</title>
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
        <h1 style="color: #203239;">Offer Your Ride</h1>
        <form action="" method="post">
            <input type="text" class="input" name="initial" placeholder="From"><br>
            <?php
             if(empty($in)==false)
              { echo $in; echo "<br>";} ?>
            <input type="text" class="input" name="destination" placeholder="To" ><br>
            <?php
             if(empty($des)==false)
              { echo $des; echo "<br>";} ?>
            <input type="number" class="input" name="carno" placeholder="Car Number"><br>
            <?php
             if(empty($cn)==false)
              { echo $cn; echo "<br>";} ?>
            <input type="date" class="input" name="date" placeholder="Date"><br>
            <?php
             if(empty($dt)==false)
              { echo $dt; echo "<br>";} ?>
            <h5>Enter the middle points</h5>
            <input type="text" class="input" name="initial1" placeholder="optional"><br>
            <input type="text" class="input" name="initial2" placeholder="optional"><br>
            <input type="text" class="input" name="initial3" placeholder="optional"><br>
            <input type="text" class="input" name="initial4" placeholder="optional"><br>
            <input type="text" class="input" name="initial5" placeholder="optional"><br>
            <input type="submit" class="input btn-primary" value="Offer" name="submit"><br>
            <?php if(empty($ans)==false){echo $ans;} ?>
        </form>
    </div>
</body>
</html>