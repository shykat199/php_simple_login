<?php 
    
    $server="localhost";
    $username="root";
    $password="123@Shykat";
    $database="users";

    $con=mysqli_connect($server,$username,$password,$database);

    if (!$con) {
        die("Error- ".mysqli_connect_error($con));
    }
?>
