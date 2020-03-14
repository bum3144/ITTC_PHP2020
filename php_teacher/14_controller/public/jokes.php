<?php
try{
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';
    // include __DIR__ . '/../includes/DatabaseFunctions.php'; // DatabaseTable파일의 class로 대체.

    $jokeTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');

    $result = $jokeTable->findAll();

    $jokes = [];

    foreach($result as $joke){
        $author = $authorsTable->findById($joke['authorid']);

        $jokes[] = [
            'id' => $joke['id'],
            'joketext' => $joke['joketext'],
            'jokedate' => $joke['jokedate'],
            'name' => $author['name'],
            'email' => $author['email']
        ];
    }


    $title = 'Joke Post List';

    $totalJokes = $jokeTable->total();
     
    ob_start(); 

    include __DIR__ . '/../templates/jokes.html.php'; 

    $output = ob_get_clean(); 

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