<?php
if(!empty($errors)):
?>
<div class="errors">
    <p>You cannot register. Please check below.</p>
    <ul>
    <?php
        foreach($errors as $error):
    ?>
        <li><?= $error; ?></li>        
    <?php
        endforeach;
    ?>
    </ul>
</div>
<?php
endif;
?>

<form action="" method="post">
    <label for="email">Email</label>
    <input name="author[email]" id="email" type="text" value="<?=$author['email'] ?? ''?>">

    <label for="name">Name</label>
    <input name="author[name]" id="name" type="text" value="<?=$author['name'] ?? ''?>">

    <label for="password">Password</label>
    <input name="author[password]" id="password" type="text" value="<?=$author['password'] ?? ''?>">

    <input type="submit" name="submit" value="Add User">
</form>