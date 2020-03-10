<?php
/*
1. If the joketext variable is not passed by POST, the input form is printed. 
    (POST로 joketext 변수가 넘어오지 않으면 form을 출력한다.)
2. When the joketext variable is passed, it adds a new joke text to the database.
    (joketext 변수가 넘어오면 데이터베이스에 신규 유머 글을 추가한다.)
*/
if(isset($_POST['joketext'])){
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=ijdb;charset=utf8;','ijdbuser','mypassword');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);     
        
        $sql = 'INSERT INTO `joke` SET
        `joketext` = :joketext,
        `jokedate` = CURDATE()';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':joketext', $_POST['joketext']);

        $stmt->execute();

        header('Location: jokes.php');

    }catch (PDOException $e){
        $title = "An error occurred!!";

        $output = 'Database error : ' . $e->getMessage() . "<br> Location file: " . $e->getFile() . "<br> Error line: " . $e->getLine();   
    }
}else{
    $title = 'Add joke posts';

    ob_start();

    include __DIR__ . '/templates/addjoke.html.php';

    $output = ob_get_clean();

}
include __DIR__ . '/templates/layout.html.php';
?>