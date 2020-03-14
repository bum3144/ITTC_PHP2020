<?php
try{
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';
        
    // deleteJoke() -> delete(), table명 추가, primary key 추가
    delete($pdo, 'joke', 'id', $_POST['id']);

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