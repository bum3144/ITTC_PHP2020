<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>get data</title>
</head>
<body>
    <h1>Get data</h1>

    <?php

    $myName = $_GET[youName];
    $myAge = $_GET[age];
    $myBirthday = $_GET[birthday];

    echo 'My name is : ' . $myName . '<br>';
    echo 'My age is : ' . $myAge . '<br>';
    echo 'My birthday is : ' . $myBirthday . '<br>';
    ?>
</body>
</html>