<?php

// new PDO('mysql:host=hostname; dbname=schemaname', 'username', 'password');


// 01. Example mysqli (mysql improved) API (PHP 5, PHP 7)
$servername = "localhost";
$username = "ittcphp";
$password = "abde1245";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";


// 02. PDO (PHP Data Object) API (PHP 5 >= 5.1.0, PHP 7)
// new PDO('mysql:host=localhost; dbname=ittcphp', 'ittcphp', 'abde1245');

// 03.
// $pdo = new PDO('mysql:host=localhost;dbname=ittcphp',
// 		'ittcphp',
//         'abde1245');

// 04.        
// try{
//     $pdo = new PDO('mysql:host=localhost;dbname=ittcphp', 'ittcphp', 'abde1245');
//         //echo "Connected successfully~!";
//         $output = 'Connected successfully!';
// }catch (PDOException $e){
//         //echo "Connection failed!";
//         $output = 'Connection failed!' . $e;
// }

// include __DIR__ . '/output.html.php';


/*
$servername = "localhost";
$dbname = "ittcphp1";
$username = "ittcphp";
$password = "abde1245";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully~!";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
*/
?>