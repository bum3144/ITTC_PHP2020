<form action="" method="post">
    <input type="hidden" name="category[id]" value="<?=$category->id ?? ''?>">
    <label for="categoryname">Category Name : </label>
    <input type="text" id="categoryname" name="category[name]" value="<?=$category->name ?? ''?>">
    <input type="submit" name="submit" value="SAVE">
</form>