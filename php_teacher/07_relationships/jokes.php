<?php
// Query modify (select + join)
try{
    $pdo = new PDO('mysql:host=localhost;dbname=ijdb;charset=utf8','ijdbuser','mypassword');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // join할 두 쿼리(Multi Tables Select)
    // SELECT `id`, LEFT(`joketext`, 20), `authorid` FROM `joke`
    // SELECT * FROM `author`
    $sql = 'SELECT `joke`.`id`, `joketext`, `name`, `email`
    FROM `joke` INNER JOIN `author`
    ON `authorid` = `author`.`id`';

    $jokes = $pdo->query($sql);

    $title = 'Joke List';
     
    ob_start(); 

    include __DIR__ . '/templates/jokes.html.php';

    $output = ob_get_clean(); 

}
catch (PDOException $e){
    $title = "An error occurred!!";

    $output = 'Database error : ' . 
    $e->getMessage() . "<br> Location file: " . 
    $e->getFile() . "<br> Error line: " . 
    $e->getLine();   
}

include __DIR__ . '/templates/layout.html.php';
?>