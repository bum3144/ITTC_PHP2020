<?php if ($userId == $jk['authorId']): ?>
<form action="" method="post">
    <input type="hidden" name="joke[id]" value="<?=$joke['id'] ?? ''?>">
    <label for="joketext">Please enter a joke post: </label>
    <textarea id="joketext" name="joke[joketext]" row="3" cols="40" style="width:400px;height:200px;"><?=$joke['joketext'] ?? ''?></textarea>
    <input type="submit" value="Save">
</form>
<?php else: ?>

<p>You can only edit your own posts.</p>

<?php endif; ?>