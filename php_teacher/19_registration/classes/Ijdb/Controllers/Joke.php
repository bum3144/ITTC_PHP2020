<?php
namespace Ijdb\Controllers;
use \Ittc\DatabaseTable;

class Joke {
    private $authorsTable;
    private $jokesTable;

	public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable) {
        $this->jokesTable = $jokesTable;
        $this->authorsTable = $authorsTable;
    }

    public function list(){
        $result = $this->jokesTable->findAll();

        $jokes = [];
        foreach($result as $joke){
            $author = $this->authorsTable->findById($joke['authorid']);

            $jokes[] = [
                'id' => $joke['id'],
                'joketext' => $joke['joketext'],
                'jokedate' => $joke['jokedate'],
                'name' => $author['name'],
                'email' => $author['email']
            ];
        }

        $title = 'Joke Post List';

        $totalJokes = $this->jokesTable->total();

        return ['template' => 'jokes.html.php', 
                'title' => $title,
                'variables' => [
                        'totalJokes' => $totalJokes,
                        'jokes' => $jokes
                    ]
                ];
    }

    public function home(){
        $title = 'Internet Joke World';

        return ['template' => 'home.html.php', 'title' => $title];
    }

    public function delete(){
        $this->jokesTable->delete($_POST['id']);

        header('Location: /joke/list');
    }

    // 폼 표시 메서드와 폼 처리 메서드로 코드 분리한다
    // 폼 표시 메서드 saveEdit(), 처리 메서드 edit()
    public function saveEdit(){

        $joke = $_POST['joke'];
        $joke['jokedate'] = new \DateTime();
        $joke['authorid'] = 1;

        $this->jokesTable->save($joke);

        header('location: /joke/list');

    }

    public function edit()
    {
        if (isset($_GET['id'])){                
            $joke = $this->jokesTable->findById($_GET['id']);
        }
        
        $title = 'Edit joke post';
            
        return ['template' => 'editjoke.html.php',
            'title' => $title,
            'variables' => [
                'joke' => $joke ?? null
            ]
        ];
    }
        
    


}



?>