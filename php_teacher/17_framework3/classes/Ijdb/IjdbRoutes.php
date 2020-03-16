<?php
namespace Ijdb;

class IjdbRoutes 
{
    public function callAction($route)
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';
     
        // namespace Ittc; namespace Ijdb; 네임스페이스 사용       
        $jokesTable = new \Ittc\DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new \Ittc\DatabaseTable($pdo, 'author', 'id');

        if($route === 'joke/list'){
            $controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
            $page = $controller->list();
        }elseif($route === ''){
            $controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
            $page = $controller->home();
        }elseif($route === 'joke/edit'){
            $controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
            $page = $controller->edit();
        }elseif($route === 'joke/delete'){
            $controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
            $page = $controller->delete();
        }elseif($route === 'register'){
            $controller = new \Ijdb\Controllers\Register($authorsTable);
            $page = $controller->showForm();
        }

        return $page;
    }
    
}


?>