<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joke view page</title>
</head>
<body>
<!--
htmlspecialchars <= Convert html entities to string characters.
ex) < => &lt; , > => &gt; , & => &amp;

echo '<blockquote><p>'. $jk .'</p></blockquote>';
echo '<p>'. htmlspecialchars($jk) .'</p>';
-->
<hr>
<h1>Version 1</h1>

    <?php if (isset($e)): ?> 
        <p>
            <?=$e;?> <!--?php echo $e; ?-->
        </p>
    <?php else: ?>        
        <?php foreach ($jokes as $jk): ?>
            <blockquote> <!--들여쓰기-->
                <p>
                    <?=htmlspecialchars($jk);?> <!--?=htmlspecialchars($jk);?-->
                </p>
            </blockquote>
        <?php endforeach; ?>        
    <?php endif; ?>

    
<!-- <hr>
<h1>Version 2</h1> -->
<?php 
    // if (isset($e)): 
    //     echo '<p>'. $e .'</p>';
    // else: // print joke text
    //     foreach ($jokes as $jk):
    //         // htmlspecialchars <= Convert html entities to string characters.
    //         // ex) < => &lt; , > => &gt; , & => &amp;

    //         // echo '<blockquote><p>'. $jk .'</p></blockquote>';
    //         // echo '<p>'. htmlspecialchars($jk) .'</p>';
    //         echo '<blockquote><p>'. htmlspecialchars($jk) .'</p></blockquote>'; //들여쓰기
    //     endforeach;        
    // endif;
?>
</body>
</html>