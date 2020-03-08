<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=ijdb;charset=utf8','ijdbuser','mypassword');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT `joketext` FROM `joke`';

    $result = $pdo->query($sql);
   
    while($row = $result->fetch()){ 
        $jokes[] = $row['joketext']; 
    }

    $title = 'Joke List';
    $output = '';
    
    // foreach ($jokes as $jk){
    //     $output .= '<blockquote>';
    //     $output .= '<p>';
    //     $output .= $jk;
    //     $output .= '</p>';
    //     $output .= '</blockquote>';
    // }

    ob_start(); // output buffering -> php가 실행되지만 브라우저로 전송되지않고 버퍼에 저장됨.

    // foreach부분을 인쿠르드 시킨다
    include __DIR__ . '/templates/jokes.html.php';

    $output = ob_get_clean(); // buffer return and remove buffer

}catch (PDOException $e){

    $output = "Database error!! <br> " . 
    $e->getMessage() . "<br> Location file: " . $e->getFile() . "<br> Error line: " . $e->getLine();
}

include __DIR__ . '/templates/layout.html.php';
?>