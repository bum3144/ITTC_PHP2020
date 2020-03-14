<?php
try{
    include __DIR__ . "/../includes/DatabaseConnection.php";
    include __DIR__ . '/../classes/DatabaseTable.php';
    // include __DIR__ . '/../includes/DatabaseFunctions.php'; // DatabaseTable파일의 class로 대체.
    
    $jokeTable = new DatabaseTable($pdo, 'joke', 'id');

    if(isset($_POST['joke'])){
        $joke = $_POST['joke'];
        $joke['jokedate'] = new DateTime();
        $joke['authorid'] = 1;

        $jokeTable->save($joke);

        header('location: jokes.php');
    }else{
        if (isset($_GET['id'])){
            $joke = $jokeTable->findById($_GET['id']);
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