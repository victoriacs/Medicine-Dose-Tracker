<?php

class User {
    /**
     * createUser
     * Creates a new user and inserts it into the database.
     */
    public function createUser($pdo, $name, $lastname, $email, $password) {
        try {
            $sql = "INSERT INTO users (name, lastname, email, password) values (?,?,?,?)";
            $query = $pdo->prepare($sql);
            $query->execute([$name, $lastname, $email, $password]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    /**
     * loginUser
     * Verifies if the user is in the table and checks if the password is correct.
     */
    public function loginUser($pdo, $email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return password_verify($password, $user['password']);
        } else {
            return false;
        }
    }

    /**
     * getUser
     * Returns the user from the database based on ther email address.
     */
    public function getUser($pdo, $email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$email]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>