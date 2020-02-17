<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP if</title>
</head>
<body>
    <?php

    $roll1 = rand(1, 6);
    $roll2 = rand(1, 6);

    echo 'Random number : ' . $roll1 . ' and ' . $roll2 . '<br>';

    if($roll1 == 6 && $roll2 == 6){
        echo '<p>You win a game!</p>';
    } else {
        echo '<p>You lose a game!</p>';
    }
    ?>
</body>
</html>