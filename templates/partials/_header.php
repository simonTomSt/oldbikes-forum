<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">OldBikes</a>

        <?php /** @var array $globalParams */
        if ($globalParams['session']['user']) : ?>
            <a href="/sign-out" class="btn btn-dark">Sign Out</a>
        <?php else : ?>
            <a href="/sign-in" class="btn btn-dark">Sign In</a>
        <?php endif; ?>
    </div>
</nav>