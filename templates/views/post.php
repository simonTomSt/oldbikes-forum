<?php /** @var array $params */ ?>
<?php /** @var array $globalParams */ ?>

<div class="card">
    <div class="card-body">
        <h1 class="card-title">
            <?php echo $params['post']['title'] ?>
        </h1>
        <h6 class="card-subtitle mb-5 mt-1 text-muted">
            <?php echo $params['author'] ?>
        </h6>
        <p class="card-text">
            <?php echo $params['post']['description'] ?>
        </p>
    </div>
</div>


<div class="mt-5">
    <h4 class="pb-2">Comments</h4>
    <ol class="list-group">
        <?php foreach ($params['comments'] as $comment): ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>
                        <p class="fw-bold">
                            <?php echo $comment['username'] ?>
                        </p>
                    </div>
                    <?php echo $comment['content'] ?>
                </div>

                <?php if ($comment['author_id'] == $globalParams['session']['user']): ?>
                    <button
                            type="button"
                            class="btn btn-sm text-muted mt-3 text-right"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteCommentModal">
                        Delete this comment
                    </button>
                <?php endif; ?>
            </li>

            <div class="modal"
                 id="deleteCommentModal"
                 tabindex="-1"
                 aria-labelledby="deleteCommentModal"
                 aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>Are you sure you want to delete this comment?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a type="button" class="btn btn-primary"
                               href=<?php echo "/comments/delete/{$comment['id']}?postId={$params['post']['id']}" ?>>Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </ol>

    <form method="POST" action=<?php echo "/comments/{$params['post']['id']}" ?>>
        <div class="mt-3">
            <?php

            generateInputField([
                "label" => "Write comment",
                "name" => "content",
                "type" => "textarea",
                "required" => true,
                "value" => $globalParams['storedFormData']['content'],
                "errorMessage" => $globalParams['errors']['content'],
            ]);
            ?>
        </div>

        <button class="mt-2 btn btn-primary" type="submit">
            Write
        </button>
    </form>
</div>


