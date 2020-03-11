<?php

try{
    include __DIR__ . '/../includes/DatabaseConnection.php';

    $sql = 'DELETE FROM `joke` WHERE `id` = :id';
   
    $stmt = $pdo->prepare($sql);  // query check!

    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();

    header('Location: jokes.php');

}
catch (PDOException $e){
    $title = "An error occurred!!";

    $output = 'Database error : ' . 
    $e->getMessage() . "<br> Location file: " . 
    $e->getFile() . "<br> Error line: " . 
    $e->getLine();   
}

include __DIR__ . '/../templates/layout.html.php';
?>