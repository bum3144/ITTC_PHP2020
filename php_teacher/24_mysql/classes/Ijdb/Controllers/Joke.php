<?php
namespace Ijdb\Controllers;
use \Ittc\DatabaseTable;
use \Ittc\Authentication;

class Joke {
	private $authorsTable;
	private $jokesTable;
	private $categoriesTable;
	private $authentication;

	public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable, DatabaseTable $categoriesTable, Authentication $authentication) {
		$this->jokesTable = $jokesTable;
		$this->authorsTable = $authorsTable;
		$this->categoriesTable = $categoriesTable;
		$this->authentication = $authentication;
	}


    public function list(){
        $jokes = $this->jokesTable->findAll();

        $title = 'Joke Post List';

		$totalJokes = $this->jokesTable->total();

		$author = $this->authentication->getUser();

		return ['template' => 'jokes.html.php', 
				'title' => $title, 
				'variables' => [
						'totalJokes' => $totalJokes,
						'jokes' => $jokes,
						'userId' => $author->id ?? null
					]
				];
	}


    public function home(){
        $title = 'Internet Joke World';

        return ['template' => 'home.html.php', 'title' => $title];
    }

	public function delete() {

		$author = $this->authentication->getUser();

		$joke = $this->jokesTable->findById($_POST['id']);

		if ($joke->authorId != $author->id) { // $author, $joke는 더이상 배열이 아니므로 객체 문법으로 수정
            return;
        }
		

		$this->jokesTable->delete($_POST['id']);

		header('location: /joke/list'); 
	}

	public function saveEdit() {
		$author = $this->authentication->getUser();

		$joke = $_POST['joke'];
		$joke['jokedate'] = new \DateTime();

		$author->addJoke($joke);

		header('location: /joke/list'); 
	}

	public function edit() {
		$author = $this->authentication->getUser();
		$categories = $this->categoriesTable->findAll();

		if (isset($_GET['id'])) {
			$joke = $this->jokesTable->findById($_GET['id']);
		}
        
        $title = 'Edit joke post';

		return ['template' => 'editjoke.html.php',
				'title' => $title,
				'variables' => [
						'joke' => $joke ?? null,
						'userId' => $author->id ?? null,
						'categories' => $categories
					]
				];
	}
	
}

