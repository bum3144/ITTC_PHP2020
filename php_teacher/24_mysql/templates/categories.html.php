<h2>Category</h2>

<a href="/category/edit">[Add Category]</a>

<?php foreach($categories as $category): ?>
<blockquote>
  <p>
  <?=htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8')?>

  <a href="/category/edit?id=<?=$category->id?>">EDIT</a>
  <form action="/category/delete" method="post">
    <input type="hidden" name="id" value="<?=$category->id?>">
    <input type="submit" value="DELETE">
  </form>
  </p>
</blockquote>

<?php endforeach; ?>
