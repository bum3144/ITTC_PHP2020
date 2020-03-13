<?php
if(isset($_POST['joketext'])){
    try{
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../includes/DatabaseFunctions.php';
        
        // insertJoke() -> insert() 변경, table명 추가
        insert($pdo, 'joke', [
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