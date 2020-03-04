<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=ijdb;charset=utf8', 'ijdbuser1', 'mypassword');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $output = 'Connected successfully!!';
}catch (PDOExeption $e){
    $output = 'Connection failed!!' . $e;
}

//echo $output;
include __DIR__ . '/output.html.php';
?>