<?php
namespace Ittc;

class Authentication{
    private $users;
    private $usernameColumn;
    private $passwordColumn;

    public function __construct(DatabaseTable $users, $usernameColumn, $passwordColumn)
    {   
        session_start();
        $this->users = $users;  // 사용자 계정 테이블을 처리할 DatabaseTable 인스턴트
        $this->usernameColumn = $usernameColumn;    // 로그인 사용자명이 저장된 칼럼명
        $this->passwordColumn = $passwordColumn;    // 로그인 비밀번호가 저장된 칼럼명
    }
    
    public function login($username, $password)
    {
        $user = $this->users->find($this->usernameColumn, strtolower($username));
                                                                // $user[0]->{$this->passwordColumn} - {중가로} 안을 먼저 해석한다
        if(!empty($user) && password_verify($password, $user[0]->{$this->passwordColumn})){
            // 사용자에게 임의의 신규 세션 ID를 할당
            session_regenerate_id(); 
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $user[0]->{$this->passwordColumn};
            return true;
        }else{
            return false;
        }
    }

    public function isLoggedIn()
    {
        if (empty($_SESSION['username'])) {
            return false;
        }

        $user = $this->users->find($this->usernameColumn, strtolower($_SESSION['username']));

        $passwordColumn = $this->passwordColumn;
                            // $user[0]->password
        if(!empty($user) && $user[0]->$passwordColumn === $_SESSION['password']){
            return true;
        }else{
            return false;
        }
    }

    public function getUser()   // 로그인 사용자의 ID를 구하려면
    {
        if($this->isLoggedIn()){
            return $this->users->find($this->usernameColumn, strtolower($_SESSION['username']))[0];
        }else{
            return false;
        }
    }

}

?>