<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=ijdb;charset=utf8','ijdbuser','mypassword');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'DELETE FROM `joke` WHERE `id` = :id';
   
    $stmt = $pdo->prepare($sql);  // query check!

    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();

    header('Location: jokes.php');

}catch (PDOException $e){
    $title = "An error occurred!!";

    $output = 'Database error : ' . 
    $e->getMessage() . "<br> Location file: " . 
    $e->getFile() . "<br> Error line: " . 
    $e->getLine();   
}

include __DIR__ . '/templates/layout.html.php';
?>