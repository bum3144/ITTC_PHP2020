<?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', '1');

# OOP => Object-oriented programming

//$myObject = new SomeClass(); // create object 객체생성
//$myObject->someProperty = 123; // property assignment 속성할당
//echo $myObject->someProperty; // use property 속성사용

try{
    $pdo = new PDO('mysql:host=localhost;dbname=ijdb', 'ijdbuser', 'mypassword');
    $output = 'Connected successfully!!';
}catch (PDOExeption $e){
    $output = 'Connection failed!!' . $e;
}

//echo $output;
include __DIR__ . '/output.html.php';
?>