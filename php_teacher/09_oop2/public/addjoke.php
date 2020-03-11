<?php
if(isset($_POST['joketext'])){
    try{
        include __DIR__ . '/../includes/DatabaseConnection.php';
        
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

    include __DIR__ . '/../templates/addjoke.html.php';

    $output = ob_get_clean();

}
include __DIR__ . '/../templates/layout.html.php';
?>