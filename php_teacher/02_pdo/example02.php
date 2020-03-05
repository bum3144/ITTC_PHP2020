<?php
//ex 01 simple error check
$dsn = "mysql:host=localhost;dbname=ijdb";
try {
    $pdo = new PDO($dsn, "ijdbuser1", "mypassword");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $output = 'Connected successfully!!';
} catch(PDOException $e) {
    $output = 'Connection failed!!' . $e;
}
include __DIR__ . '/output.html.php';


// //ex 02 big size site error check
// $dsn = "mysql:host=localhost;dbname=ijdb";
// try {
//     $pdo = new PDO($dsn, "ijdbuser1", "mypassword");
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $output = 'Connected successfully!!';
// } catch(PDOException $e) {
//     $output = 'Connection failed!!' . 
//     $e->getMessage() . ', location: ' .
//     $e->getFile() . ':' . $e->getLine();
// }
// include __DIR__ . '/output.html.php';
?>
