<?php
namespace Ijdb;

class IjdbRoutes 
{
    public function callAction($route)
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';
     
        $jokesTable = new \Ittc\DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new \Ittc\DatabaseTable($pdo, 'author', 'id');

        $jokeController = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);

        $routes = [
            'joke/edit' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'edit'
                ]
            ],
            'joke/delete' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'delete'
                ]
            ],
            'joke/list' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'list'
                ]
            ],
            '' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'home'
                ]
            ]
        ];

        $method = $_SERVER['REQUEST_MOTHOD'];
        $controller = $routes[$route][$mothod]['controller'];
        $action = $routes[$route][$mothod]['action'];

        return $controller->$action();
        
    }
    
}


?>