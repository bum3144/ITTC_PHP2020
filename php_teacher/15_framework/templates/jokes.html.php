<p>There are [ <?=$variables['totalJokes'];?> ] joke posts.</p> 
<?php foreach ($jokes as $jk): ?>
    <blockquote> 
        <p>
        <?=htmlspecialchars($jk['joketext'], ENT_QUOTES, 'UTF-8');?>

        (Author: <a href="mailto:<?php 
            echo htmlspecialchars($jk['email'], ENT_QUOTES, 'UTF-8');?>"><?php 
            echo htmlspecialchars($jk['name'], ENT_QUOTES, 'UTF-8');?></a>
            Post date: 
            <?php
                $date = new DateTime($jk['jokedate']);
                echo $date->format('jS F Y');
                //echo $date->format('Y-m-d');
            ?>)

        <a href="index.php?action=edit&id=<?=$jk['id'];?>">EDIT</a>

        <form action="index.php?action=delete" method="post">
            <input type="hidden" name="id" value="<?=$jk['id'];?>">
            <input type="submit" value="DEL">
        </form>
        </p>
    </blockquote>
<?php endforeach; ?>  
