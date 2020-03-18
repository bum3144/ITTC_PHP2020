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

    public function registerUser()
    {
        $author = $_POST['author'];

        // 데이터는 처음부터 유효하다고 가정
        $valid = true;
        $errors = []; //등록 불가 사유를 구체적으로 알리기 위해 $error배열에 오류 메시지 추가

        // 항목이 비었으면 false
        if(empty($author['name'])){
            $valid = false;
            $errors[] = 'please input your name';
        }
        if(empty($author['email'])){
            $valid = false;
            $errors[] = 'please input your email';
        }
        if(empty($author['password'])){
            $valid = false;
            $errors[] = 'please input your password';
        }

        // $valid 가 ture이면 데이터를 추가할 수 있음
        if($valid === true){
            $this->authorsTable->save($author);
            
            header('Location: /author/success');
        }else{
            // 데이터가 유효하지 않으면 폼을 다시 출력
            return ['template' => 'register.html.php',
                'title' => 'Add User',
                'variables' => [
                    'errors' => $errors,
                    'author' => $author
                ]
            ];
        }

    }

}