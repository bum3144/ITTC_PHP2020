<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Do While</title>
</head>
<body>
    <h1>do while</h1>

    <?php
    
    do {
        $roll = rand(1, 6);
        echo '<p>Random number is : ' . $roll . '</p>' ;

        if ($roll == 6) {
            echo '<p>You win!</p>';
        } else {
            echo '<p>You lose!</p>';
        }
    } while ($roll !=6);

    ?>
</body>
</html>