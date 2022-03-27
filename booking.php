<?php
require_once "config.php";
session_start();

if(!isset($_SESSIONSESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
$initial = $destination = "";
$err = "";
$ans="";
$date="";


$time;
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $initial = $_POST['initial'];
    $destination = $_POST['destination'];
    $date=$_POST['date'];
    $sql = "SELECT * FROM `booking`";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        if($row['initial']==$initial and $row['destination']==$destination and $row['date']==$date and $row['seating']<5)
        {
            
            $num=$row['seating'];
            $num++;
            $carnum=$row['car_no.'];
            $upd = "UPDATE `booking` SET `seating` = $num WHERE `car_no.` = $carnum";
            $result1=mysqli_query($conn,$upd);
            if($result1)
            {
                echo "Entered";
                $ans="Booking has been done";
                break;
            }
        }
    }
    if(empty(trim($ans)))
    {
        $ans="Cab cannot be book";
    }
}


?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
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
        <h1 style="color: #203239;">Book Your Cab</h1>
        <form action="" method="post">
            <input type="text" class="input" name="initial" placeholder="From"><br>
            <input type="text" class="input" name="destination" placeholder="To" ><br>
            <input type="date" class="input" name="date" placeholder="Date"><br>
            <input type="submit" class="input btn-primary" value="Book" name="submit"><br>
            <?php if(empty($ans)==false){echo $ans;} ?>
        </form>
    </div>
</body>
</html>