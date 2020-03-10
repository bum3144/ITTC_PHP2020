<?php foreach ($jokes as $jk): ?>
    <blockquote> 
        <p>
        <?=htmlspecialchars($jk['joketext'], ENT_QUOTES, 'UTF-8');?>

        (Author: <a href="mailto:<?php 
            echo htmlspecialchars($jk['email'], ENT_QUOTES, 'UTF-8');?>"><?php 
            echo htmlspecialchars($jk['name'], ENT_QUOTES, 'UTF-8');?></a>)

        <form action="deletejoke.php" method="post">
            <input type="hidden" name="id" value="<?=$jk['id'];?>">
            <input type="submit" value="DEL">
        </form>
        </p>
    </blockquote>
<?php endforeach; ?>  
