<?php
namespace Ittc;

class EntryPoint 
{
    private $route;
    private $method;
    private $routes;

    // 생성자 인수에 타입힌트를 지정
    public function __construct(string $route, string $method, \Ijdb\IjdbRoutes $routes)
    {
        $this->route = $route;
        $this->method = $method;
        $this->routes = $routes;
        $this->checkUrl();
    }

    // 소문자 URL 이동 시키는 기능
    private function checkUrl()
    {
        if($this->route !== strtolower($this->route)){
            http_response_code(301);
            header('location: ' . strtolower($this->route));
        }
    }

    private function loadTemplate($templateFileName, $variables = [])
    {
        extract($variables);
    
        ob_start();    
        include __DIR__ . '/../../templates/' . $templateFileName;
    
        return ob_get_clean(); 
    }

    public function run()
    {   
        $routes = $this->routes->getRoutes();

        $controller = $routes[$this->route][$this->method]['controller'];
        $action = $routes[$this->route][$this->method]['action'];
       
        $page = $controller->$action();

        $title = $page['title'];

        if(isset($page['variables'])){
            $output = $this->loadTemplate($page['template'], $page['variables']);
        }else{
            $output = $this->loadTemplate($page['template']);
        }

        include __DIR__ . '/../../templates/layout.html.php';
    }



}

?>