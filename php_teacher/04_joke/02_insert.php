<?php
try{
// new PDO('mysql:host=hostname; dbname=schemaname', 'username', 'password');
// $pdo->exec($query);

    $pdo = new PDO("mysql:host=localhost;dbname=ijdb;charset=utf8","ijdbuser","mypassword");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'INSERT INTO `joke1` SET
            `joketext` = "Hello~ \"ITTC\". Good morning everyone.",
            `jokedate` = "2020-03-05"';

    $pdo ->exec($sql);

    $output = "Successfully insert data!!";
}catch(PDOException $e){
    $output = "Database error!! <br> " . 
    $e->getMessage() . "<br> Location file: " . 
    $e->getFile() . "<br> Error line: " . 
    $e->getLine();
}
include __DIR__ . '/output.html.php';
?>