<?php
// 03.
function loadTemplate($templateFileName, $variables = []){

    extract($variables);

    ob_start();    
    include __DIR__ . '/../templates/' . $templateFileName;

    return ob_get_clean(); 
}

try{
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';
    include __DIR__ . '/../classes/controllers/JokeController.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');

    $jokeController = new JokeController($jokesTable, $authorsTable);

    // // 01
    // if(isset($_GET['edit'])){
    //     $page = $jokeController->edit();
    // }elseif(isset($_GET['delete'])){
    //     $page = $jokeController->delete();
    // }elseif(isset($_GET['list'])){
    //     $page = $jokeController->list();
    // }else{
    //     $page = $jokeController->home();
    // }

    // 02 if문 대체 - 널 병합 연산자를 활용 컨트롤러 함수
    $action = $_GET['action'] ?? 'home';

    $page = $jokeController->$action();

    $title = $page['title'];

    if(isset($page['variables'])){
        $output = loadTemplate($page['template'], $page['variables']);
    }else{
        $output = loadTemplate($page['template']);
    }

}catch (PDOException $e){

    $title = "An error occurred!!";

    $output = 'Database error : ' . 
    $e->getMessage() . "<br> Location file: " . 
    $e->getFile() . "<br> Error line: " . 
    $e->getLine();  

}
  
    include __DIR__ . '/../templates/layout.html.php';
?>