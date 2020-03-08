<?php foreach ($jokes as $jk): ?>
    <blockquote> 
        <p>
        <?=htmlspecialchars($jk, ENT_QUOTES, 'UTF-8');?>
        </p>
    </blockquote>
<?php endforeach; ?>  
