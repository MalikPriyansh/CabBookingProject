<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "login";

    $conn = mysqli_connect($servername,$username,$password,$database);

    if($conn)
    {
        echo "Connection has been setup successfully <br>";
    }
    else
    {
        die("Connection cannot be setup ". mysqli_connect_error());
    }
    
?>
