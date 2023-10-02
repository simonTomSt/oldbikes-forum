<div class="position-fixed d-flex flex-column flex-shrink-0 p-3 text-white bg-dark"
     style="height: 100vh; width: 280px;">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/posts" class="nav-link <?php /** @var array $globalParams */
            echo ($globalParams['currentRoute'] === '/posts') ? 'active' : ''; ?>"
               aria-current="page">
                Posts
            </a>
        </li>
        <li class="nav-item">
            <a href="/my-posts"
               class="nav-link <?php echo ($globalParams['currentRoute'] === '/my-posts') ? 'active' : ''; ?>"
               aria-current="page">
                My posts
            </a>
        </li>
    </ul>
</div>
