<?php

class Medicine {
    private $id;
    private $user_id;
    private $name;
    private $dosage;
    private $frequency;

    function __construct($name, $dosage, $frequency) {
        $this->id = null;
        $this->user_id = null;
        $this->name = $name;
        $this->dosage = $dosage;
        $this->frequency = $frequency;
        
    }

    public function create($pdo, $user_id, $name, $dosage, $frequency) {
        try {
            $sql = "INSERT INTO medicines (user_id, name, dosage, frequency) values (?,?,?,?)";
            $query = $pdo->prepare($sql);
            $query->execute([$user_id, $name, $dosage, $frequency]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of dosage
     */ 
    public function getDosage()
    {
        return $this->dosage;
    }

    /**
     * Set the value of dosage
     *
     * @return  self
     */ 
    public function setDosage($dosage)
    {
        $this->dosage = $dosage;

        return $this;
    }

    /**
     * Set the value of frequency
     *
     * @return  self
     */ 
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }
}

?>