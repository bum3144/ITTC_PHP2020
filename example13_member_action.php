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
        $userid = $_GET[userid];
        $userpw = $_GET[userpw];
        $userpw2 = $_GET[userpw2];
        $firstname = $_GET[firstname];
        $middlename = $_GET[middlename];
        $lastname = $_GET[lastname];
        $birth = $_GET[birth];
        $address = $_GET[address];
        $post  = $_GET[post];

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