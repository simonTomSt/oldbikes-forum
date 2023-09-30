<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Sign In
                </div>
                <div class="card-body">
                    <form action="/sign-in" method="POST">
                        <div class="mb-3">
                            <?php
                            /** @var array $globalParams */
                            generateInputField([
                                "label" => "Username",
                                "name" => "username",
                                "type" => "text",
                                "required" => true,
                                "value" => $globalParams['storedFormData']['username'],
                                "errorMessage" => $globalParams['errors']['username'],
                            ]);
                            ?>
                        </div>
                        <div class="mb-3">
                            <?php
                            /** @var array $globalParams */
                            generateInputField([
                                "label" => "Password",
                                "name" => "password",
                                "type" => "password",
                                "required" => true,
                                "value" => $globalParams['storedFormData']['password'],
                                "errorMessage" => $globalParams['errors']['password'],
                            ]);
                            ?>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </form>
                </div>

                <p class="text-center mt-3">
                    <a href="/sign-up" class="link-primary">Are you new? Just create an account</a>
                </p>
            </div>
        </div>
    </div>
</div>