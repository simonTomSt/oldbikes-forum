<section class="container mr-auto">
    <a class="btn btn-primary btn-lg mb-5" href="/create-post" role="button">Create a new post!</a>

    <ol class="list-group">
        <?php /** @var array $params */
        foreach ($params['posts'] as $post): ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><?php echo $post['title']; ?></div>
                    <?php echo $post['description']; ?>
                </div>
                <!--                <span class="badge bg-primary rounded-pill">-->
                <?php //echo $post['likes']; ?><!--</span>-->
            </li>
        <?php endforeach; ?>
    </ol>
</section>
