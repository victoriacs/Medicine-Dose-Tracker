<?php 
include_once("../models/UserModel.php");
include_once("../config/database.php");

$error_messages = [];
session_start();
// If the user is already logged in, prevent them from logging in again
if (isset($_SESSION['logged'])) {
    header("Location: account");
    die();
} else {
    // If the form has been submitted
    if (isset($_POST['submit'])) {
        // If the email and password are submitted
        if (isset($_POST['email'],$_POST['password'])) {
            //email
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['email'];
            } else {
                $error_messages['email'][] = "Introduzca un email valido.";
            }
            //password
            $password = $_POST['password'];
            
            // If there are no errors, attempt to log in.
            if (empty($error_messages)) {
                $user = new User();
                $result = $user->loginUser($pdo, $email, $password);
                // If the credentials are correct, redirect to the account page. 
                    if ($result) {
                        $resultUser = $user->getUser($pdo,$email);
                        $_SESSION['logged'] = $resultUser;
                        header("Location: account");
                        die();
                    // If not, display an error message and allow the user to try again.
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