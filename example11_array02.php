<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP array 02</title>
</head>
<body>
    <h1>Array</h1>

    <?php

    $numbers = [];

    $numbers[1] = "one";
    $numbers[2] = "two";
    $numbers[3] = "three";
    $numbers[4] = "four";
    $numbers[5] = "five";
    $numbers[6] = "six";

    echo $numbers[3] . '<br>';
    echo $numbers[5] . '<br><hr>';

    $var1 = 3;
    $var2 = 5;

    echo $numbers[$var1] .'<br>';
    echo $numbers[$var2] .'<br><hr>';

    $phil = [
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six'
    ];

    $roll = rand(1, 6);
    echo '<p> Random number is : ' . $phil[$roll] . '</p>';

    if($roll == 6){
        echo '<p>You Win!</p><hr>';
    }else{
        echo '<p>You lose!</p> <hr>';
    }


    $birthdays['jeremy'] = '21-jan-2020';
    $birthdays['john'] = '01-dec-1998';
    $birthdays['anna'] = '30-jan-1991';
    echo 'john birthday : ' . $birthdays['john'] .'<br><hr>';

    $youBirth=[
        'jeremy' => '21-jan-2020',
        'john' => '01-dec-1998',
        'anna' => '30-jan-1991'
    ];
    echo 'anna birthday : ' . $birthdays['anna'] .'<br><hr>';
    ?>
</body>
</html>