<section class="container mr-auto">
    <a class="btn btn-primary btn-lg mb-5" href="/create-post" role="button">Create a new post!</a>

    <ol class="list-group">
        <?php /** @var array $params */
        foreach ($params['posts'] as $post): ?>
            <li class="list-group-item d-flex justify-content-between align-items-start py-4">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><?php echo $post['title']; ?></div>
                    <?php
                    // Truncate the description to a maximum of 300 characters
                    $truncatedDescription = strlen($post['description']) > 300 ? substr($post['description'], 0, 300) . '...' : $post['description'];
                    echo $truncatedDescription;
                    ?>

                    <div class="pt-4">
                        <a class="btn btn-outline-primary btn-sm" href=<?php echo $post['id']; ?>>Read more</a>
                    </div>
                </div>
                <!--                <span class="badge bg-primary rounded-pill">-->
                <?php //echo $post['likes']; ?><!--</span>-->
            </li>
        <?php endforeach; ?>
    </ol>

    <div class="mt-4">
        <?php
        generatePagination($params['totalCount'], $params['baseUrl'], $params['offset'], $params['limit']);
        ?>
    </div>
</section>
