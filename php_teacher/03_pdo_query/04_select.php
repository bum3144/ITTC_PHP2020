<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=ijdb;charset=utf8','ijdbuser','mypassword');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT `joketext` FROM `joke`';
    // $pdo->exec($sql); <= exec: create, insert, update method
    // $pdo->query($sql); <= query: select method - return data

    $result = $pdo->query($sql);
    // 01. while
    while($row = $result->fetch()){ // fetch() <= The fetch method returns each row of the result set as an array.
        $jokes[] = $row['joketext']; // The keys of each array are the same as the column names of the table.
    }

    // 02. foreach (좀더 정돈된 코드)
    // foreach($result as $row){ 
    //     $jokes[] = $row['joketext']; 
    // }
    
}catch (PDOException $e){

    $output = "Database error!! <br> " . 
    $e->getMessage() . "<br> Location file: " . 
    $e->getFile() . "<br> Error line: " . 
    $e->getLine();

}

// 01.
// jokes.html.php로 이동하여 출력할 부분
// if (isset($e)){
//     echo $e;
// }else{

//     // print joke text
//      foreach ($jokes as $jk){
//         echo $jk;
//      }
// }

// 02.
// if (isset($e)):
//     echo $e;
// else:

//     // print joke text
//      foreach ($jokes as $jk):
//         echo $jk;
//      endforeach;
     
// endif;

include __DIR__ . '/jokes.html.php';
?>