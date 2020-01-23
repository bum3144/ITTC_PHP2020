<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP while</title>
</head>
<body>
    <?php

    // while( condition ) {
    //
    // }
        
    // while($count <= 10){
    //     echo $count . ' ';
    //     ++$count;
    // }

    $roll = 0;
    while($roll != 6){
        $roll = rand(1, 6);
        echo '<p>Random number : ' . $roll . '</p>';

        if($roll == 6){
            echo '<p>Win</p>';
        }else{
            echo '<p>Lose</p>';
        }
    }

    ?>
</body>
</html>