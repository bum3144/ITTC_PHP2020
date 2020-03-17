<?php
//   echo phpinfo(); die;
try{
    include __DIR__ . '/../includes/autoload.php';
    
    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    
    // namespace Ittc; namespace Ijdb; 네임스페이스 사용
    $entryPoint = new \Ittc\EntryPoint($route, new \Ijdb\IjdbRoutes());
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