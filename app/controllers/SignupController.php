<?php 
include_once("../models/UserModel.php");
include_once("../config/database.php");

$error_messages = [];
$message_global;
session_start();
// If the user is already logged in, prevent them from register again
if (isset($_SESSION['logged'])) {
    header("Location: account");
    die();
} else {
    // If the form has been submitted
    if(isset($_POST['submit'])) {
        // If the information are submitted
        if (isset($_POST['name'],$_POST['lastname'],$_POST['email'],$_POST['password'])) {
            
            //name
            if (!preg_match('/[0-9]/', $_POST['name']) && strlen($_POST['name']) <= 25) {
                $name = ucwords(strtolower($_POST['name']));
            } else {
                $error_messages['name'][] = "The name is not valid!";
            }
            //lastname
            if (!preg_match('/[0-9]/', $_POST['lastname']) && strlen($_POST['lastname']) <= 25) {
                $lastname = ucwords(strtolower($_POST['lastname']));
            } else {
                $error_messages['lastname'][] = "The lastname is not valid";
            }

            //email
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['email'];
            } else {
                $error_messages['email'][] = "The email is not valid!";
            }

            //password
            $uppercase = preg_match('@[A-Z]@', $_POST['password']);
            $lowercase = preg_match('@[a-z]@', $_POST['password']);
            $number = preg_match('@[0-9]@', $_POST['password']);
            $specialChars = preg_match('@[^\w]@', $_POST['password']);
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST['password']) < 8) {
                $error_messages['password'][] = 'The password must be at least 8 characters long and must include at least one capital letter, one number and one special character.';
            } else {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
            
            // If there are no errors, attempt to sign up.
            if (empty($error_messages)) {
                $user = new User();
                $result = $user->createUser($pdo, $name, $lastname, $email, $password);
                 // If the user has been successfully created, set a cookie and redirect to the login page.
                if($result) {
                    setcookie('currentRegistration', $email);
                    header("Location: login");
                    die();
                // If the user is already registered display an error message and allow the user to try again.
                } else {
                    $message_global = "User already registered.";
                }
            }
        }
    } else {
        $message_global = "All fields are required.";
    }
    include("../views/user/signup.php");
}

?>