<?php
if(isset($_POST['joketext'])){
    try{
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../includes/DatabaseFunctions.php';
        
        // 파라미터를 배열로 수정하여 전달
        insertJoke($pdo, [
            'authorid' => 1,
            'joketext' => $_POST['joketext'], 
            'jokedate' => new DateTime()
            ]);

        header('Location: jokes.php');

    }catch (PDOException $e){
        $title = "An error occurred!!";

        $output = 'Database error : ' . $e->getMessage() . "<br> Location file: " . $e->getFile() . "<br> Error line: " . $e->getLine();   
    }
}else{
    $title = 'Add joke posts';

    ob_start();

    include __DIR__ . '/../templates/addjoke.html.php';

    $output = ob_get_clean();

}
include __DIR__ . '/../templates/layout.html.php';
?>