<?php
namespace Ittc;

class EntryPoint 
{
    private $route;
    private $routes;

    public function __construct($route, $routes)
    {
        $this->route = $route;
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
        $page = $this->routes->callAction($this->route);

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