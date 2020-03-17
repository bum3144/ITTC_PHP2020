<?php
namespace Ijdb\Controllers;
use \Ittc\DatabaseTable;

class Register{
    private $authorsTable;

    public function __construct(DatabaseTable $authorsTable)
    {
        $this->authorsTable = $authorsTable;
    }

    public function registrationForm()
    {
        return ['template' => 'register.html.php',
            'title' => 'Add User'];
    }

    public function success()
    {
        return ['template' => 'registersuccess.html.php',
            'title' => 'Successful Registration'];
    }


}