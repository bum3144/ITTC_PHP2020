<?php
namespace Ijdb\Controllers;

class Login{
    private $authentication;

    public function __construct(\Ittc\Authentication $authentication) {
        $this->authentication = $authentication;
    }

    public function loginForm() {
        return ['template' => 'login.html.php', 'title' => 'Log In'];
    }
    public function processLogin()
    {
        if($this->authentication->login($_POST['email'], $_POST['password'])) {
            header('location: /login/success');
        }else{
            return ['template' => 'login.html.php',
                'title' => 'Log In',
                'variables' => [
                    'error' => 'Username or password is invalid.'
                ]
            ];
        }
    }

    public function success()
    {
        return ['template' => 'loginsuccess.html.php',
            'title' => 'Login Successful'];
    }

    public function error()
    {
        return ['template' => 'loginerror.html.php',
                'title' => 'You are not logged in. Please log in and try again.'];
    }

    public function logout()
    {
        unset($_SESSION);
        return ['template' => 'logout.html.php',
            'title' => 'You are logged out.'];
    }
}
 