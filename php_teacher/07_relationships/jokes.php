<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=ijdb;charset=utf8','ijdbuser','mypassword');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT `id`, `joketext` FROM `joke`';
   
    // 01. while
    // $result = $pdo->query($sql);
    // while($row = $result->fetch()){ 
    //     $jokes[] = ['id' => $row['id'], 'joketext' => $row['joketext']]; 
    // }  

    // 02. foreach를 사용해 본다
    // $result = $pdo->query($sql);
    // foreach ($result as $row){ 
    //     $jokes[] = array('id' => $row['id'], 'joketext' => $row['joketext']); 
    // }

    // 03. 템플릿에서 사용할 $jokes 변수는 배열이 아니라 PDOStatement 객체로 바뀌었다
    // $result = $pdo->query($sql);
    // $jokes = $result;


    // 04. Finish
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