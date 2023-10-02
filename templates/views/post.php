<div class="card">
    <div class="card-body">
        <h1 class="card-title">
            <?php /** @var array $params */
            echo $params['post']['title'] ?>
        </h1>
        <h6 class="card-subtitle mb-5 mt-1 text-muted">
            <?php /** @var array $params */
            echo $params['author'] ?>
        </h6>
        <p class="card-text">
            <?php /** @var array $params */
            echo $params['post']['description'] ?>
        </p>
    </div>
</div>