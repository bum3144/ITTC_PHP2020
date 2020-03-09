<?php foreach ($jokes as $jk): ?>
    <blockquote> 
        <p><!-- 이전에는 select할때 joketext 컬럼만 불러왔기에 $jk만 입력했지만, 현재는 id도 불러오기에 변경한다. -->
        <?=htmlspecialchars($jk['joketext'], ENT_QUOTES, 'UTF-8');?>
        <form action="deletejoke.php" method="post">
            <input type="hidden" name="id" value="<?=$jk['id'];?>">
            <input type="submit" value="DEL">
        </form>
        </p>
    </blockquote>
<?php endforeach; ?>  
