<?php
namespace Ijdb\Entity;

class Author {
    public $id;
    public $name;
    public $email;
    public $password;
    public $jokesTable;

    public function __construct(\Ittc\DatabaseTable $jokesTable)
    {
        $this->jokesTable = $jokesTable;
    }

    public function getJoke()
    {
        return $this->jokesTable->find('authorid', $this->id);
    }

    public function addJoke($joke)
    {
        $joke['authorid'] = $this->id;
        $this->jokesTable->save($joke);
    }

}
