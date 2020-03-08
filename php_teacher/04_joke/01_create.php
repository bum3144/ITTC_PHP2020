<?php
try{
// new PDO('mysql:host=hostname; dbname=schemaname', 'username', 'password');
// $pdo->exec($query);

    $pdo = new PDO("mysql:host=localhost;dbname=ijdb;charset=utf8","ijdbuser","mypassword");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE joke (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        joketext TEXT,
        jokedate DATE NOT NULL
    ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB";

    $pdo ->exec($sql);

    $output = "Successfully created a joke table!!";
}catch(PDOException $e){
    $output = "Database error!! <br> " . 
    $e->getMessage() . "<br> Location file: " . 
    $e->getFile() . "<br> Error line: " . 
    $e->getLine();
}
include __DIR__ . '/output.html.php';
?>