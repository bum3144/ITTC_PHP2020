<?php
//     // 참고사이트 : https://www.php.net/manual/en/reserved.variables.globals.php
//     // 이 함수를 호출하면 전역변수 $pdo가 함수 내부변수 $db에 저장된다
//     // dependency injection (의존성 주입 기법 이라 한다)
//     // 함수는 전용 파일에 모아 두는 편이 좋다. 예)includes/DatabaseFunctions.php
// // 01.
// function totalJokes($db){    
//     $query = $db->prepare('SELECT COUNT(*) FROM `joke`');  // query check!
//     $query->execute();
//     $row = $query->fetch();
//     return $row[0];
// }

// function getJoke($pdo, $id){
//     $query = $pdo->prepare('SELECT * FROM `joke` WHERE `id` = :id');
//     $query->bindValue(`:id`, $id);
//     $query->execute();
//     return $query->fetch();
// }

// // =========================================================================
// // 02. 쿼리를 입력받아 실행하는 함수를 선언
// function query($pdo, $sql, $id){
//     $query = $pdo->prepare($sql);
//     $query->bindValue(':id', $id);
//     $query->execute();

//     return $query;
// }

// function totalJokes($db){
//     $query = query($db, 'SELECT COUNT(*) FROM `joke`');    
//     $row = $query->fetch();
//     return $row[0];
// }

// function getJoke($pdo, $id){
//     $query = query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id', $id);
//     return $query->fetch();
// }

// // =========================================================================
// // 03. query() 함수에서 :id만 처리할 수 있어 유연성이 떨어짐
// // 유동적으로 쿼리를 처리하도록 매개변수를 배열로 만들어 query()함수에 전달
// function query($pdo, $sql, $parameters){
//     $query = $pdo->prepare($sql);

//     foreach($parameters as $name => $value){
//         $query->bindValue($name, $value);
//     }
//     $query->execute();

//     return $query;
// }

// function totalJokes($db){
//     // query() 함수로 보낼 빈 배열 생성
//     $parameters = [];

//     // qudry() 함수가 받아야 할 인수는 세 개인데 두 개만 전달하면 오류가 발생
//     // query() 함수를 호출할 때 빈 $parameters 배열을 전달
//     $query = query($db, 'SELECT COUNT(*) FROM `joke`', $parameters);    
//     $row = $query->fetch();
//     return $row[0];
// }

// function getJoke($pdo, $id){
//     // query() 함수에서 사용할 $parameters 배열 생성
//     $parameters = [':id' => $id];
//     $query = query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id', $parameters);
//     return $query->fetch();
// }

// =========================================================================
// 04. 인수를 선언할 때 기본 값을 지정하면 인수를 전달하지 않아도 자동으로 기본값이 지정된다.
// ex) function fn($arqument1=1) => 인수를 지정하지 않고 호출하면 $arqument1 변수에 1이 전달된다 
function query($pdo, $sql, $parameters = []){
    $query = $pdo->prepare($sql);

    // foreach($parameters as $name => $value){
    //     $query->bindValue($name, $value);
    // }
    // $parameters를 execute에 직접 전달하면 foreach와 똑같은 기능을 수행하며 일일이 바인드를 할 필요가 없다.
    $query->execute($parameters);

    return $query;
}

function totalJokes($db){
    //$parameters = []; // 이제 빈 파라미터는 전달할 필요가 없기에 생략.
    $query = query($db, 'SELECT COUNT(*) FROM `joke`');    
    $row = $query->fetch();
    return $row[0];
}

function getJoke($pdo, $id){
    $parameters = [':id' => $id];
    $query = query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id', $parameters);
    return $query->fetch();
}














?>