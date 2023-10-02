<section>
    <div class="card">
        <div class="card-header">
            Create a new post
        </div>
        <div class="card-body">
            <form action="/create-post" method="POST">
                <div class="mb-3">
                    <?php
                    /** @var array $globalParams */
                    generateInputField([
                        "label" => "Post title",
                        "name" => "title",
                        "type" => "text",
                        "required" => true,
                        "value" => $globalParams['storedFormData']['title'],
                        "errorMessage" => $globalParams['errors']['title'],
                    ]);
                    ?>
                </div>
                <div class="mb-3">
                    <?php
                    /** @var array $globalParams */
                    generateInputField([
                        "label" => "Post Content",
                        "name" => "description",
                        "type" => "textarea",
                        "required" => true,
                        "value" => $globalParams['storedFormData']['description'],
                        "errorMessage" => $globalParams['errors']['description'],
                    ]);
                    ?>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</section>