<?php
function totalJokes($db){    
    // 참고사이트 : https://www.php.net/manual/en/reserved.variables.globals.php
    // 이 함수를 호출하면 전역변수 $pdo가 함수 내부변수 $db에 저장된다
    // dependency injection (의존성 주입 기법 이라 한다)
    // 함수는 전용 파일에 모아 두는 편이 좋다. 예)includes/DatabaseFunctions.php
    $query = $db->prepare('SELECT COUNT(*) FROM `joke`');  // query check!
    $query->execute();

    $row = $query->fetch();

    return $row[0];
}

?>