<?php
$dsn = "mysql:host=localhost;dbname=ijdb";
try {
    $pdo = new PDO($dsn, "ijdbuser1", "mypassword");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $output = 'Connected successfully!!';
} catch(PDOException $e) {
    //echo $e->getMessage();
    $output = 'Connection failed!!' . $e;
}
include __DIR__ . '/output.html.php';
?>
