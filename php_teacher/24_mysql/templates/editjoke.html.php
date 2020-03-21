<?php if (empty($joke->id) || $userId == $joke->authorId): ?>
<form action="" method="post">
    <input type="hidden" name="joke[id]" value="<?=$joke->id ?? ''?>">
    <label for="joketext">Please enter a joke post: </label>
    <textarea id="joketext" name="joke[joketext]" rows="3" cols="40" style="width:400px;height:200px;"><?=$joke->joketext ?? ''?></textarea>
    
    <p>Select Joke category : </p>
    <?php foreach ($categories as $category): ?>    
    <input type="checkbox" name="category[]" value="<?=$category->id?>">   <label><?=$category->name?></label>


    <?php endforeach; ?>
    
    <input type="submit" name="submit" value="Save">
</form>
<?php else: ?>

<p>You can only edit your own posts.</p>

<?php endif; ?>