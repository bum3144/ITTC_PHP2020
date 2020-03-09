<!--
* All templates have the following structure as a whole.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="jokes.css"> 
    <!-- <title>IJDB - INTERNET JOKE WORLD</title> -->
    <title><?=$title?></title>
</head>
<body>
    <nav>
        <?php include 'nav.html.php'; ?>
        <!-- <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="jokes.php">Joke List</a></li>
        </ul> -->
    </nav>

    <main>
        <?php if (isset($error)): ?>
        <p>
            <?=$error;?>
        </p>
        <?php else: ?>
            <!-- : Text output, form output, database output.

            : The part that shows what you want. -->
            <?=$output;?>
        <?php endif; ?>
    </main>

    <footer>
        <?php include 'footer.html.php'; ?>
        <!-- (c) IJDB 2020 -->
    </footer>
</body>
</html>