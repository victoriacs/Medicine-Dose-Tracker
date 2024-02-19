<?php

class User {
    
    private $name;
    private $lastname;
    private $password;

    function __construct() {
        $this->name = null;
        $this->lastname = null;
        $this->password = null;
        
    }
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

    public function getUser($pdo, $email) {
        $sql = "SELECT name, lastname, email FROM users WHERE email = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$email]);
        $result =  $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     */
    public function setLastname($lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }
}

?>