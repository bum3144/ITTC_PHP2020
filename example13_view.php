<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    $id = $_GET['id'];

$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', 'zxcv1234');
$stmt = $pdo->prepare('SELECT * FROM example13_member WHERE id = ?');
$stmt->execute([ $id ]);
$item = $stmt->fetch();

echo 'USER ID : ' . $item['userid'] .'<br>';
echo 'PASSWORD : ' . $item['password'] .'<br>';
echo 'FIRST NAME : ' . $item['firstname'] .'<br>';
echo 'MIDDLE NAME : ' . $item['middlename'] .'<br>';
echo 'LAST NAME : ' . $item['lastname'] .'<br>';
echo 'BIRTHDAY : ' . $item['birthday'] .'<br>';
echo 'ADDRESS : ' . $item['address'] .'<br>';
echo 'POST NUMBER : ' . $item['post'] .'<br>';
    ?>
</body>
</html>