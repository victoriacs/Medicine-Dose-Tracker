<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="form.css">
    <title>Signup</title>
</head>

<body>
    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Register Today</h3>
                        <p>Fill in the data below.</p>

                        <form class="form" action="signup" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="name" placeholder="Name"
                                        maxlength="25" required>
                                    <?php 
                                    if(isset($error_messages['name'])) {
                                        echo "<div class='invalid'>";
                                    foreach ($error_messages['name'] as $error_message) {
                                        echo "<p>$error_message</p>";
                                    }
                                        echo "</div>";} 
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="lastname" placeholder="Lastname"
                                        maxlength="25" required>
                                    <?php 
                                    if(isset($error_messages['lastname'])) {
                                        echo "<div class='invalid'>";
                                    foreach ($error_messages['lastname'] as $error_message) {
                                        echo "<p>$error_message</p>";
                                    }
                                        echo "</div>";} 
                                    ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="email" name="email" placeholder="E-mail Address"
                                    maxlength="100" required>
                                <?php 
                                if(isset($error_messages['email'])) {
                                    echo "<div class='invalid'>";
                                foreach ($error_messages['email'] as $error_message) {
                                    echo "<p>$error_message</p>";
                                }
                                    echo "</div>";} 
                                ?>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="password" name="password" placeholder="Password"
                                    minlength="8" required>
                                <?php 
                                if(isset($error_messages['password'])) {
                                    echo "<div class='invalid'>";
                                foreach ($error_messages['password'] as $error_message) {
                                    echo "<p>$error_message</p>";
                                }
                                    echo "</div>";} 
                                ?>
                            </div>
                            <?php 
                                if(isset($message_global)) {
                                    echo "<div class='invalid'>";
                                    echo "<p>$message_global</p>";
                                
                                    echo "</div>";} 
                                ?>
                            <div class="col-md-12 d-flex">
                                <div class="form-button mt-3">
                                    <button id="submit" type="submit" name="submit"
                                        class="btn btn-primary">Register</button>
                                </div>
                                <p class="signup-link m-0 ps-2 pt-3 align-self-center">Already have an account?<a
                                        href="login" class="ps-1">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>