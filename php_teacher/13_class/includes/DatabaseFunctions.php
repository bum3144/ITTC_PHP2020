<?php

// query
function query($pdo, $sql, $parameters = []){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

// // All joke post
// function totalJokes($db){
//    $query = query($db, 'SELECT COUNT(*) FROM `joke`');    
//     $row = $query->fetch();
//     return $row[0];
// }

// joke post
function getJoke($pdo, $id){	
	// query() 함수에서 사용할 $parameters 배열 생성
    $parameters = [':id' => $id];
	// query() 함수에서 사용할 $parameters 배열 제공
    $query = query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id', $parameters);
    return $query->fetch();
}

// // INSERT joke
// function insertJoke($pdo, $fields){
//     $query = 'INSERT INTO `joke` (';

//     foreach($fields as $key => $value){
//         $query .= '`' . $key . '`,';
//     }

//     $query = rtrim($query, ',');  

//     $query .= ') VALUES (';

//     foreach($fields as $key => $value){
//         $query .= ':'.$key.',';
//     }

//     $query = rtrim($query, ',');

//     $query .= ')';

//     $fields = processDates($fields); // DateTime

//     query($pdo, $query, $fields);
// }


// // UPDATE joke 
// function updateJoke($pdo, $fields){
//     $query = 'UPDATE `joke` SET ';

//     foreach($fields as $key => $value){
//         $query .= '`' . $key . '` = :'. $key . ',';
//     }

//     $query = rtrim($query, ','); // 쿼리 끝에 쉽표 제거

//     $query .= ' WHERE `id` = :primaryKey';

//     $fields['primarykey'] = $fields['id']; // :primaryKey 변수 설정
    
//     $fields = processDates($fields); // DateTime
    
//     query($pdo, $query, $fields);
// }


// // Delete joke
// function deleteJoke($pdo, $id){
//     $parameters = [':id' => $id];
//     query($pdo, 'DELETE FROM `joke` WHERE `id` = :id', $parameters);
// }


// // joke 
// function allJokes($pdo){
//     $jokes = query($pdo, 'SELECT `joke`.`id`, `joketext`, `jokedate`, `name`, `email` 
//         FROM `joke` INNER JOIN `author` 
//         ON `authorid` = `author`.`id`');
//     return $jokes->fetchAll();
// }

// DateTime
function processDates($fields){
    foreach ($fields as $key => $value){
        // $value가 DateTime 객체라면...
        if($value instanceof DateTime){
            // Y-m-d H:i:s 형식으로 변환해라
            $fields[$key] = $value->format('Y-m-d H:i:s');
        }
    }    

    return $fields;
}

// All authors
function allAuthors($pdo){
    $author = query($pdo, 'SELECT * FROM `author`');

    return $author->fetchAll();
}

// Delete author
function deleteAuthor($pdo, $id){
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM `author` WHERE `id` = :id', $parameters);
}

// Insert author
function insertAuthor($pdo, $fields){
    $query = 'INSERT INTO `author` (';

    foreach($fields as $key => $value){
        $query .= '`' . $key . '`,';
    }

    $query = rtrim($query, ',');  

    $query .= ') VALUES (';

    foreach($fields as $key => $value){
        $query .= ':'.$key.',';
    }

    $query = rtrim($query, ',');

    $query .= ')';

    $fields = processDates($fields); // DateTime

    query($pdo, $query, $fields);
}

// Table 호출 함수
function findAll($pdo, $table){
    $result = query($pdo,'SELECT * FROM `' . $table . '`');

    return $result->fetchAll();
}

// delete 
function delete($pdo, $table, $primaryKey, $id){
    $parameters = [':id' => $id ];
    query($pdo, 'DELETE FROM `' . $table . '` 
        WHERE `' . $primaryKey . '` = :id', $parameters);
}

// insert
function insert($pdo, $table, $fields){
    $query = 'INSERT INTO `' . $table . '` (';

    foreach($fields as $key => $value){
        $query .= '`' . $key . '`,'; 
    }

    $query = rtrim($query, ',');

    $query .= ') VALUES (';

    foreach($fields as $key => $value){
        $query .= ':' . $key . ',';
    }

    $query = rtrim($query, ',');

    $query .= ')';
    
    $fields = processDates($fields);

    query($pdo, $query, $fields);
}

// update
function update($pdo, $table, $primaryKey, $fields){
    $query = 'UPDATE `' . $table . '` SET ';

    foreach($fields as $key => $value){
        $query .= '`' . $key . '` = :' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ' WHERE `' . $primaryKey . '` = :primaryKey';
    // :primaryKey 변수 설정
    $fields['primaryKey'] = $fields['id'];

    $fields = processDates($fields);

    query($pdo, $query, $fields);
}

function findById($pdo, $table, $primaryKey, $value){
    $query = 'SELECT * FROM `' . $table . '` 
        WHERE `' . $primaryKey . '` = :value';
        
    $parameters = [
        'value' => $value
    ];

    $query = query($pdo, $query, $parameters);

    return $query->fetch();
}

function total($pdo, $table){
    $query = query($pdo, 'SELECT COUNT(*) FROM `' . $table . '`');

    $row = $query->fetch();

    return $row[0];
}

// try...catch문을 save()함수로 선언 - insert(), update() 구분
function save($pdo, $table, $primaryKey, $record) {
    try{
        if($record[$primaryKey] == '') {    // 기본키는 대부분 INT며 정수만 허용. 빈문자열을 전달하면 오류가 발생한다.
            $record[$primaryKey] = null;   // null을 지정하면 auto_increment 기능이 실행된다
        }
        insert($pdo, $table, $record);
    }catch (PDOException $e){
        update($pdo, $table, $primaryKey, $record);
    }
} 



?>