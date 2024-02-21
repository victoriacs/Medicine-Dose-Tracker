<?php 
include_once("../models/UserModel.php");
include_once("../config/database.php");

$error_messages = [];
session_start();
if (isset($_SESSION['logged'])) {
    header("Location: account");
    die();
} else {
    if (isset($_POST['submit'])) {
        if (isset($_POST['email'],$_POST['password'])) {
            //email
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['email'];
            } else {
                $error_messages['email'][] = "Introduzca un email valido.";
            }
            //password
            $password = $_POST['password'];
            if (empty($error_messages)) {
                $user = new User();
                $result = $user->loginUser($pdo, $email, $password);
                    if ($result) {
                        $resultUser = $user->getUser($pdo,$email);
                        $_SESSION['logged'] = $resultUser;
                        // $_SESSION['logged'] = serialize($user);
                        header("Location: account");
                        die();
                    } else {
                        $error_messages['user'][] = "Incorrect credentials";
                    }
            }
        } else {
            $error_messages['user'][] = "All fields are required.";
        }
    }
    include("../views/user/login.php");
} 

?>