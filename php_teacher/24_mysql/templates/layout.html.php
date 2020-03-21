<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
    <!-- <link rel="shortcut icon" href="#" /> -->
    <link rel="stylesheet" href="/jokes.css"> 
    <title><?=$title?></title>
</head>
<body>
    <nav>
        <header>
            <h1>INTERNET JOKE WORLD</h1>
        </header>
        <ul>
            <li><a href="/">HOME</a></li>
            <li><a href="/joke/list">JOKE LIST</a></li>
            <li><a href="/joke/edit">JOKE ADD</a></li>
            <?php if ($loggedIn): ?>
            <li><a href="/logout">Logout</a></li>
            <?php else: ?>
            <li><a href="/login">Log In</a></li>
            <?php endif; ?>
        </ul>
    </nav>  

    <main>
	<?=$output?>
    </main>

    <footer>
        <p id="footer">
        The content of this web page is copyrighted. 
        copyright &copy; 2019&ndash;<?php echo date('Y'); ?> Example ITTC. All Rights Reserved.
        </p>
    </footer>

</body>
</html>