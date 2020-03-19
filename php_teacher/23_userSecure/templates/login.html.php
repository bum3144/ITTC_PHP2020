<?php
if(isset($error)):
    echo '<div class="errors">' . $error . '</div>';
endif;
?>
<form method="post" action="">
    <label for="email">E-mail</label>
    <input type="text" name="email" id="email">

    <label for="password">Password</label>
    <input type="password" name="password" id="password">

    <input type="submit" name="login" value="LOG IN">
</form>

<p>Don't have an account? <a href="/author/register">Click to register!</a></p>