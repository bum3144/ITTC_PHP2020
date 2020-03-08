<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joke view page</title>
</head>
<body>

    <?php if (isset($e)): ?> 
        <p>
            <?=$e;?>
        </p>
    <?php else: ?>        
        <?php foreach ($jokes as $jk): ?>
            <blockquote> 
                <p>
                    <?=htmlspecialchars($jk);?>
                </p>
            </blockquote>
        <?php endforeach; ?>        
    <?php endif; ?>


</body>
</html>