<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP for</title>
</head>
<body>
    <?php

    // for($count = 1; $count <= 10; $count = $count + 3){
    //     echo $count . '<br>';
    // }

    for ($count=1; $count <= 10; $count++){
        $roll = rand(1, 6);
        echo  "<p>" . $count . " random number : " . $roll . "</P>";

        if($roll == 6){
            echo "<p>You win!!</p>";
        }else{
            echo "<p>You lose!!</p>";
        }
    }


    ?>
</body>
</html>