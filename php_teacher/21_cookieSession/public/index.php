<?php
   echo phpinfo(); die;

if(!isset($_COOKIE['visits'])){
    $_COOKIE['visits'] = 0;
}
$visits = $_COOKIE['visits'] + 1;
setcookie('visits', $visits, time() + 3600 * 24 * 365);

if($visits > 1){
    echo "$visits 번째 방문하셨습니다.";
}else{
    // 첫 방문
    echo "웹사이트에 오신 걸 환영합니다. 둘러보려면 여기를 클릭하세요!";
}


try{
    include __DIR__ . '/../includes/autoload.php';
    
    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    
    // EntryPoint 생성자로 $method를 전달한다
    $entryPoint = new \Ittc\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \Ijdb\IjdbRoutes());
    $entryPoint->run();

}catch (\PDOException $e){

    $title = "An error occurred!!";

    $output = 'Database error : ' . 
    $e->getMessage() . "<br> Location file: " . 
    $e->getFile() . "<br> Error line: " . 
    $e->getLine();  

    include __DIR__ . '/../templates/layout.html.php';
}  
?>