<?php
function query($pdo, $sql, $parameters = []){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function totalJokes($db){
   $query = query($db, 'SELECT COUNT(*) FROM `joke`');    
    $row = $query->fetch();
    return $row[0];
}

function getJoke($pdo, $id){	
	// query() 함수에서 사용할 $parameters 배열 생성
    $parameters = [':id' => $id];
	// query() 함수에서 사용할 $parameters 배열 제공
    $query = query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id', $parameters);
    return $query->fetch();
}

//2 수정 INSERT
function insertJoke($pdo, $fields){
    $query = 'INSERT INTO `joke` (';

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

//1 수정 UPDATE 
function updateJoke($pdo, $fields){
    $query = 'UPDATE `joke` SET ';

    foreach($fields as $key => $value){
        $query .= '`' . $key . '` = :'. $key . ',';
    }

    $query = rtrim($query, ','); // 쿼리 끝에 쉽표 제거

    $query .= ' WHERE `id` = :primaryKey';

    $fields['primarykey'] = $fields['id']; // :primaryKey 변수 설정
    
    $fields = processDates($fields); // DateTime
    
    query($pdo, $query, $fields);
}

function deleteJoke($pdo, $id){
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM `joke` WHERE `id` = :id', $parameters);
}

// 4. 날짜 가져오기
function allJokes($pdo){
    $jokes = query($pdo, 'SELECT `joke`.`id`, `joketext`, `jokedate`, `name`, `email` 
        FROM `joke` INNER JOIN `author` 
        ON `authorid` = `author`.`id`');
    return $jokes->fetchAll();
}

// 3. 날짜 형식
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


















?>