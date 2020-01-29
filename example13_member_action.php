<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>join action</title>
</head>
<body>
    <?php
        $userid = $_POST[userid];
        $userpw = $_POST[userpw];
        $userpw2 = $_POST[userpw2];
        $firstname = $_POST[firstname];
        $middlename = $_POST[middlename];
        $lastname = $_POST[lastname];
        $birth = $_POST[birth];
        $address = $_POST[address];
        $post  = $_POST[post];

        $pdo = new PDO('mysql:host=localhost;dbname=test', 'root', 'zxcv1234');

        $stmt = $pdo->prepare('INSERT INTO example13_member (
            userid, password, firstname, middlename, lastname, birthday, address, post
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?
        )');
        $stmt->execute([ $userid, $userpw, $firstname, $middlename, $lastname, $birth, $address, $post ]);

        echo 'USER ID : ' . $userid .'<br>';
        echo 'PASSWORD : ' . $userpw .'<br>';
        echo 'PASSWORD CHECK : ' . $userpw2 .'<br>';
        echo 'FIRST NAME : ' . $firstname .'<br>';
        echo 'MIDDLE NAME : ' . $middlename .'<br>';
        echo 'LAST NAME : ' . $lastname .'<br>';
        echo 'BIRTHDAY : ' . $birth .'<br>';
        echo 'ADDRESS : ' . $address .'<br>';
        echo 'POST NUMBER : ' . $post .'<br>';
    ?>
</body>
</html>