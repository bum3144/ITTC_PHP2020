<?php
try{
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';

    $jokes = allJokes($pdo);

    $title = 'Joke List';

    $totalJokes = totalJokes($pdo);
     
    ob_start(); 

    include __DIR__ . '/../templates/jokes.html.php'; // error 발생시 해당 파일을 비워두고 다음을 실행한다
    // require __DIR__ . '/../templates/jokes.html.php'; // error 발생시 해당 지점에서 실행을 멈춘다
    // php.ini 설정에서 경고와 오류 출력을 막는 경우가 많기 때문에 오류를 일으켜도 화면에 출력되지 않는 경우가 많다(아예 빈 페이지가 나올때도 있다)

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