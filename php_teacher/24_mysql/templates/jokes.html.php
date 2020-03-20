<p>There are [ <?=$variables['totalJokes'];?> ] joke posts.</p> 
<?php foreach ($jokes as $jk): ?>
<blockquote> 
    <p>
    <?=htmlspecialchars($jk['joketext'], ENT_QUOTES, 'UTF-8');?>

    (Author: <a href="mailto:<?=htmlspecialchars($jk['email'], ENT_QUOTES, 'UTF-8');?>">
    <?=htmlspecialchars($jk['name'], ENT_QUOTES, 'UTF-8');?></a>
        Post date: 
        <?php
            $date = new DateTime($jk['jokedate']);
            
            echo $date->format('jS F Y');
        ?>)

    <?php if ($userId == $jk['authorId']): ?>
        <a href="/joke/edit?id=<?=$jk['id'];?>">EDIT</a>
        <form action="/joke/delete" method="post">
            <input type="hidden" name="id" value="<?=$jk['id'];?>">
            <input type="submit" value="DEL">
        </form>
    <?php endif; ?>
    </p>
</blockquote>
<?php endforeach; ?>  
