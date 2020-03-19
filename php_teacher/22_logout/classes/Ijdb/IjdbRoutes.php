<?php
namespace Ijdb;

// IjdbRoutes가 인터페이스를 상속하도록 implements를 지정해야 한다.
class IjdbRoutes implements \Ittc\Routes {
    private $authorsTable;
    private $jokesTable;
    private $authentication;

    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';
     
        $this->jokesTable = new \Ittc\DatabaseTable($pdo, 'joke', 'id');
        $this->authorsTable = new \Ittc\DatabaseTable($pdo, 'author', 'id');
        $this->authentication = new \Ittc\Authentication($this->authorsTable, 'email', 'password');
    }
    
    // callAction() 메서드명을 getRoutes()고치고 함수 $route 인수를 제거한다음 return문을 추가해 $route를 반환한다.
    public function getRoutes(): array {
        $jokeController = new \Ijdb\Controllers\Joke($this->jokesTable, $this->authorsTable);
        $authorController = new \Ijdb\Controllers\Register($this->authorsTable);

        $loginController = new \Ijdb\Controllers\Login($this->authentication);

        $routes = [
            'author/register' => [
                'GET' => [
                    'controller' => $authorController,
                    'action' => 'registrationForm'
                ],
                'POST' => [
                    'controller' => $authorController,
                    'action' => 'registerUser'
                ]
            ],
            'author/success' => [
                'GET' => [
                    'controller' => $authorController,
                    'action' => 'success'
                ]
            ],
            'joke/edit' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'edit'
                ],
                'login' => true
            ],
            'joke/delete' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'delete'
                ],
                'login' => true
            ],
            'joke/list' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'list'
                ]
            ],
            'login/error' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'error'
                ]
            ],
            'login/success' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'success'
                ],
                'login' => true
            ],
            'login' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'loginform'  
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'processLogin'
                ]
            ],
            'logout' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'logout'
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

    public function getAuthentication(): \Ittc\Authentication {
        return $this->authentication;
    }
    
}


?>