<?php
function loadTemplate($templateFileName, $variables = []){

    extract($variables);

    ob_start();    
    include __DIR__ . '/../templates/' . $templateFileName;

    return ob_get_clean(); 
}
try{
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';
    
    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');
    
    $route = $_GET['route'] ?? 'joke/home';

    // route 변수가 없으면 'joke/home' 할당
    // $route = $_GET['route'] ?? 'joke/home';
    
    // $_SERVER['REQUEST_URI'] : 현재페이지의 주소에서 도메인 제거 ex) /joke/home?user=test
    // strtok($_SERVER['REQUEST_URI'], '?') ? 와 이후 문자를 제거 ex) /joke/home
    // ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/') 문자열 맨 앞에 있는 / 를 제거 ex) joke/home
    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

     if ($route == strtolower($route)){
        if($route === 'joke/list'){
            include __DIR__ . '/../classes/controllers/JokeController.php';
            $controller = new JokeController($jokesTable, $authorsTable);
            $page = $controller->list();
        }elseif($route === ''){
            include __DIR__ . '/../classes/controllers/JokeController.php';
            $controller = new JokeController($jokesTable, $authorsTable);
            $page = $controller->home();
        }elseif($route === 'joke/edit'){
            include __DIR__ . '/../classes/controllers/JokeController.php';
            $controller = new JokeController($jokesTable, $authorsTable);
            $page = $controller->edit();
        }elseif($route === 'joke/delete'){
            include __DIR__ . '/../classes/controllers/JokeController.php';
            $controller = new JokeController($jokesTable, $authorsTable);
            $page = $controller->delete();
        }elseif($route === 'register'){
            include __DIR__ . '/../classes/controllers/RegisterController.php';
            $controller = new RegisterController($authorsTable);
            $page = $controller->showForm();
        }

    } else {
        http_response_code(301);
        header('location: index.php?route=' . strtolower($route));
    }
    

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