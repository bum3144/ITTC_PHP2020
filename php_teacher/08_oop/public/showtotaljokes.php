<?php
// ## dependency injection 의존성 주입 기법이란 한 변수를 여러 곳에서 안전하게 사용하는 기법
// An include file that creates the $pdo variable and connects to the database.
// $pdo 변수를 생성하고 데이터베이스로 접속하는 인크루드 파일.
include __DIR__ . '/../includes/DatabaseConnection.php';

// Include totalJokes() function
// totalJokes() 함수가 선언된 인클루드 파일.
include __DIR__ . '/../includes/DatabaseFunctions.php';


// called function
echo totalJokes($pdo);

?>