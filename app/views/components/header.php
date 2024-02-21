<?php
setcookie('currentRegistration', '');
if (session_status() == PHP_SESSION_NONE && empty($_SESSION)) {
    session_start();
}
?>
<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <a href="home" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <span class="fs-4">Medicine Dose Tracker</span>
            </a>
            <ul class="nav justify-content-center mb-md-0">
                <li><a href="home" class="nav-link px-2 link-secondary">Home</a></li>
                <?php
                    if (isset($_SESSION['logged'])) {
                    ?>
                <li><a href="account" class="nav-link px-2 link-secondary">Medicine List</a></li>
                <?php } ?>
            </ul>

            <div class="text-end d-flex flex-wrap align-items-center">
                <?php
                    if (isset($_SESSION['logged'])) {
                    ?>
                <?php
                    echo "Hello " . $_SESSION['logged']['name'] . ' ' . $_SESSION['logged']['lastname'] . '!';
                    ?> <a class="btn btn-outline-light  ms-2" href="logout" role="button">Logout</a>
                <?php
                    } else {
                    ?>
                <a class="btn btn-outline-light me-2" href="login" role="button">Login</a>
                <a class="btn btn-warning me-2" href="signup" role="button">Register</a>
                <?php
                    } 
                    ?>

            </div>
        </div>
    </div>
</header>