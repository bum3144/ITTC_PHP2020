<?php
    // Databses connection

    //01. Example mysqli (mysql improved) API (PHP 5, PHP 7)
    $servername = 'localhost';
    $username = 'ittc';
    $password = 'zxcv1234';

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);
    // Check connection
    // if($conn){
    //     echo "Connected successfully";
    // }else{
    //     die("Cennection failed: " . mysqli_connect_error());
    // }
    if(!$conn){
        die("Cennection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
?>

