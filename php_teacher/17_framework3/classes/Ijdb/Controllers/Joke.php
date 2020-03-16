<?php

class Joke {
    private $authorsTable;
    private $jokesTable;

	public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable) {
        $this->jokesTable = $jokesTable;
        $this->authorsTable = $authorsTable;
    }

    // jokes.php
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
    // index.php
    public function home(){
        $title = 'Internet Joke World';

        return ['template' => 'home.html.php', 'title' => $title];
    }

    // deletejoke.php
    public function delete(){
        $this->jokesTable->delete($_POST['id']);

        // header('Location: index.php?action=list');
        header('Location: /joke/list');
    }

    // editjoke.php
    public function edit(){
        if(isset($_POST['joke'])){

            $joke = $_POST['joke'];
            $joke['jokedate'] = new DateTime();
            $joke['authorid'] = 1;
    
            $this->jokesTable->save($joke);
    
            // header('location: index.php?action=list');
            header('location: /joke/list');

        }else{

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


}



?>