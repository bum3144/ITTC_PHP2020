<?php
namespace Ijdb;

class IjdbRoutes 
{
    // callAction() 메서드명을 getRoutes()고치고 함수 $route 인수를 제거한다음 return문을 추가해 $route를 반환한다.
    public function getRoutes()
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

        return $routes;        
    }
    
}


?>