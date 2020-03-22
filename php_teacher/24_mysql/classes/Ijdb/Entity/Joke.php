<?php
namespace Ijdb\Entity;

class Joke {
	public $id;
	public $authorId;
	public $jokedate;
	public $joketext;
	private $authorsTable;
	private $author;
	private $jokeCategoriesTable;

	public function __construct(\Ittc\DatabaseTable $authorsTable, \Ittc\DatabaseTable $jokeCategoriesTable) {
		$this->authorsTable = $authorsTable;
		$this->jokeCategoriesTable = $jokeCategoriesTable;
	}

	public function getAuthor() {
		if (empty($this->author)) {
			$this->author = $this->authorsTable->findById($this->authorId);
		}
		
		return $this->author;
	}

	public function addCategory($categoryId) {
		$jokeCat = ['jokeId' => $this->id, 'categoryId' => $categoryId];

		$this->jokeCategoriesTable->save($jokeCat);
	}
}