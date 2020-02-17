<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Array</title>
</head>
<body>
    <h1>Array</h1>

    <?php

    $myArray = ['school', 2, '100'];

    echo $myArray[0] .'<br>'; // scholl
    echo $myArray[1] .'<br>'; // 2
    echo $myArray[2] .'<br><hr>'; // 100

    $myArray[1] = 3;    
    echo $myArray[1] .'<br><hr>'; 

    $myArray[2] = 'park';
    echo $myArray[2] .'<br><hr>';

    $myArray[3] = 4;
    echo $myArray[3] . '<br><hr>';

    $myArray[] = 5;
    echo $myArray[4] . '<br><hr>';
    ?>

</body>
</html>