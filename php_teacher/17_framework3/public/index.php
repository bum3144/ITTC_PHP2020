<?php
try{
    include __DIR__ . '/../classes/EntryPoint.php';
    
    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    
    $entryPoint = new EntryPoint($route);
    $entryPoint->run();

}catch (PDOException $e){

    $title = "An error occurred!!";

    $output = 'Database error : ' . 
    $e->getMessage() . "<br> Location file: " . 
    $e->getFile() . "<br> Error line: " . 
    $e->getLine();  

    include __DIR__ . '/../templates/layout.html.php';
}  
?>