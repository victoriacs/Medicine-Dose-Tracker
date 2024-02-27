<?php
// The session destroys and redirect to home
session_start();
session_destroy();
header("Location: home");
die();
?>