<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Sign Up
                </div>
                <div class="card-body">
                    <form action="/sign-up" method="POST">
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
                                "label" => "Email",
                                "name" => "email",
                                "type" => "email",
                                "required" => true,
                                "value" => $globalParams['storedFormData']['email'],
                                "errorMessage" => $globalParams['errors']['email'],
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

                        <div class="mb-3">
                            <?php
                            /** @var array $globalParams */
                            generateInputField([
                                "label" => "Confirm Password",
                                "name" => "confirmPassword",
                                "type" => "password",
                                "required" => true,
                                "value" => $globalParams['storedFormData']['confirmPassword'],
                                "errorMessage" => $globalParams['errors']['confirmPassword'],
                            ]);
                            ?>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




