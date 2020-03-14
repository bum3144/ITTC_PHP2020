<?php
include __DIR__ . "/../includes/DatabaseConnection.php";
include __DIR__ . "/../includes/DatabaseFunctions.php";

try{
    if(isset($_POST['joke'])){
        // updateJoke() -> update(), table명 추가, primary key 추가
        // 이제는 update() 대신 save()함수로 대체한다           
        // form 필드 데이터는 PHP 배열 형태로 전달된다 
        // 전달된 $_POST['joke]는 단일값이 아니라 배열이다.
        $joke = $_POST['joke'];
        $joke['jokedate'] = new DateTime();
        $joke['authorid'] = 1;

        save($pdo, 'joke', 'id', $joke);

        header('location: jokes.php');
    }else{
        if (isset($_GET['id'])){
            $joke = findById($pdo, 'joke', 'id', $_GET['id']);
        }
        
        $title = 'Edit joke post';

        ob_start();

        include __DIR__ . "/../templates/editjoke.html.php";

        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = "An error occurred!!";

    $output = 'Database error : ' . $e->getMessage() . "<br> Location file: " . $e->getFile() . "<br> Error line: " . $e->getLine();   
}

include __DIR__ . "/../templates/layout.html.php";
?>