<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>php if</title>
</head>
<body>
    <?php
        // if(condition) {
        //     
        // }

        $roll = rand(1,6);

        echo "random number is : " . $roll . "<br>"; 

        if($roll > 3 ){
            echo "you win! <br>";
        } else {
            echo " you lose! next game! <br>";
        }

        echo "Thank you !!"
    ?>
</body>
</html>