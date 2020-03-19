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