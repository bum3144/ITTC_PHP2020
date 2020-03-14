<?php
try{
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';
    // include __DIR__ . '/../includes/DatabaseFunctions.php'; // DatabaseTable파일의 class로 대체.
        
    $jokeTable = new DatabaseTable ($pdo, 'joke', 'id');
    
    $jokeTable->delete($_POST['id']);

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