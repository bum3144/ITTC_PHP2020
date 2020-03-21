<p>There are [ <?=$totalJokes?> ] joke posts.</p> 
<?php foreach ($jokes as $joke): ?>
<blockquote> 
    <p>
    <?=htmlspecialchars($joke->joketext, ENT_QUOTES, 'UTF-8');?>

    (Author: <a href="mailto:<?=htmlspecialchars($joke->getAuthor()->email, ENT_QUOTES,
                    'UTF-8'); ?>">
                <?=htmlspecialchars($joke->getAuthor()->name, ENT_QUOTES,
                    'UTF-8'); ?></a> 
        Post date: 
        <?php
            $date = new DateTime($joke->jokedate);
            
            echo $date->format('jS F Y');
        ?>)

    <?php if ($userId == $joke->authorId): ?>
        <a href="/joke/edit?id=<?=$joke->id;?>">EDIT</a>
        <form action="/joke/delete" method="post">
            <input type="hidden" name="id" value="<?=$joke->id;?>">
            <input type="submit" value="DEL">
        </form>
    <?php endif; ?>
    </p>
</blockquote>
<?php endforeach; ?>  
