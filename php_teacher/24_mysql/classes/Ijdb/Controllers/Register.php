<?php
namespace Ijdb\Controllers;
use \Ittc\DatabaseTable;

class Register{
    private $authorsTable;

    public function __construct(DatabaseTable $authorsTable) {
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

    public function registerUser() {
        $author = $_POST['author'];

        // 데이터는 처음부터 유효하다고 가정
        $valid = true;
        $errors = []; //등록 불가 사유를 구체적으로 알리기 위해 $error배열에 오류 메시지 추가

        // 항목이 비었으면 false
        if(empty($author['name'])){
            $valid = false;
            $errors[] = 'please input your name.';
        }
        if(empty($author['email'])){
            $valid = false;
            $errors[] = 'please input your email.';
        }else if(filter_var($author['email'], FILTER_VALIDATE_EMAIL) == false){
            $valid = false;
            $errors[] = 'Invalid email address.';
        }else{ // 이메일 주소가 비어있지 않고 유효하다면

            // 이메일 주소를 소문자로 변환ㄴ
            $author['email'] = strtolower($author['email']);

            // $author['email']을 소문자로 검색
            if(count($this->authorsTable->find('email', $author['email'])) > 0) {
                $valid = false;
                $errors[] = 'Already registered email address.';
            }
        }
        if(empty($author['password'])){
            $valid = false;
            $errors[] = 'please input your password.';
        }

        // $valid 가 ture이면 데이터를 추가할 수 있음
        if($valid === true){

            // 데이터베이스에 저장하기 전에 비밀번호를 해시화
            $author['password'] = password_hash($author['password'], PASSWORD_DEFAULT);

            // form이 전송되면 $author변수는 소문자 이메일과 비밀번호 해시값을 포함
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