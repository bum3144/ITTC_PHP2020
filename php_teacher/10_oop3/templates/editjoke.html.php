<form action="" method="post">
    <input type="hidden" name="jokeid" value="<?=$joke['id'];?>">
    <label for="joketext">Please enter a joke post: </label>
    <textarea id="joketext" name="joketext" row="3" cols="40" style="width:400px;height:200px;"><?=$joke['joketext'];?></textarea>
    <input type="submit" value="Save">
</form>