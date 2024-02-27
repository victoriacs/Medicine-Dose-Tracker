<?php

class Medicine {

    /**
     * create
     * Creates a new medicine and inserts it into the database.
     */
    public function create($pdo, $user_id, $name, $dosage, $frequency) {
        try {
            $sql = $pdo->prepare("INSERT INTO medicines (user_id, name, dosage, frequency) values (?,?,?,?)");
            $sql->execute([$user_id, $name, $dosage, $frequency]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    /**
     * update
     * Updates medicine information in the database for a specific user.
     */
    public function update($pdo, $name, $dosage, $frequency, $medicine_id, $user_id) {
        try {
            $sql = $pdo->prepare("UPDATE medicines SET name=?, dosage=?, frequency=? WHERE id=? AND user_id=?");
            $sql->execute([$name, $dosage, $frequency, $medicine_id, $user_id]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    /**
     * delete
     * Deletes a medicine from the database for a specific user.
     */
    public function delete($pdo, $medicine_id, $user_id) {
        try {
            $sql = $pdo->prepare("DELETE FROM medicines WHERE id = ? AND user_id = ?");
            $sql->execute([$medicine_id, $user_id]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    /**
     * showAll
     * Shows all the medicines for a specific user.
     */
    public function showAll($pdo, $user_id) {
        try {
            $sql = $pdo->prepare("SELECT * FROM medicines WHERE user_id = ?");
            $sql->execute([$user_id]);
            return $sql->fetchAll();;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }
}

?>