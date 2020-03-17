<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#" />
    <link rel="stylesheet" href="/jokes.css"> 
    <title><?=$title?></title>
</head>
<body>

    <?php include 'nav.html.php'; ?>

    <main>
        <?php if (isset($error)): ?>
        <p>
            <?=$error;?>
        </p>
        <?php else: ?>
            <?=$output;?>
        <?php endif; ?>
    </main>

    <?php include 'footer.html.php'; ?>

</body>
</html>