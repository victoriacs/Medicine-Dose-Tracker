<?php 
include_once("../models/MedicineModel.php");
include_once("../config/database.php");

session_start();
if (isset($_SESSION['logged'])) {
    
    $url = $_SERVER['REQUEST_URI'];
    $urlSegments = explode('/', rtrim($url, '/'));
    $action = end($urlSegments);
    $url_components = parse_url($action);
    
    if (isset($url_components['query'])) {
        parse_str($url_components['query'], $params);
        if (isset($params['id'])) {
            $medicine_id = $params['id'];
        }
    }
            switch ($url_components['path']) {
                case 'add':
                    createMedicine($pdo);
                    break;
                case 'update':
                    updateMedicine($pdo, $medicine_id);
                    break;
                case 'delete':
                    deleteMedicine($pdo, $medicine_id);
                    break;
                case 'account':
                    showAll($pdo);
                    break;
                case 'default':
                    break;
            }
} else {
    header("Location: login");
    die();
} 

function createMedicine($pdo) {
    if (isset($_POST['add'])) {
        $validationForm = validateForm($_POST['name'], $_POST['dosage'],$_POST['dosage_unit'],$_POST['frequency']);
        $error_messages = $validationForm['errors'];
        $valid_values = $validationForm['values'];

        $dosage = strval($valid_values['dosage_qt']) . ' ' . $valid_values['dosage_unit'];
        $user_id = implode([$_SESSION['logged']['id']]);
        $name = $valid_values['name'];
        $frequency = $valid_values['frequency'];

        if (empty($error_messages)) {
            $sql = $pdo->prepare("INSERT INTO medicines (user_id, name, dosage, frequency) values (?,?,?,?)");
            $sql->execute([$user_id, $name, $dosage, $frequency]);
            header("Location: ../account");
            die();
        }

    }
include("../views/medicine/add.php");
}

function updateMedicine($pdo, $medicine_id) {
    $sql = $pdo->prepare("SELECT * FROM medicines WHERE id = ? AND user_id = ?");
    $sql->execute([$medicine_id,$_SESSION['logged']['id']]);
    $medicines = $sql->fetch();
    if (!empty($medicines)) {
        $name = $medicines['name'];
        $dosage = explode(" ", $medicines['dosage']);
        $dosage_qt = $dosage[0];
        $dosage_unit = $dosage[1];
        $frequency = $medicines['frequency'];
        if (isset($_POST['update'])) {
            $validationForm = validateForm($_POST['name'], $_POST['dosage'],$_POST['dosage_unit'],$_POST['frequency']);
            $error_messages = $validationForm['errors'];
            $valid_values = $validationForm['values'];
            $dosage_qt = $valid_values['dosage_qt'];
            $dosage_unit = $valid_values['dosage_unit'];
            $dosage = strval($valid_values['dosage_qt']) . ' ' . $valid_values['dosage_unit'];
            $name = $valid_values['name'];
            $frequency = $valid_values['frequency'];
    
            if (empty($error_messages)) {
                $sql = $pdo->prepare("UPDATE medicines SET name=?, dosage=?, frequency=? WHERE id=?");
                $sql->execute([$name, $dosage, $frequency, $medicine_id]);
                header("Location: ../account");
                die();
            }
        }
        require("../views/medicine/update.php");
    } else {
        
    }
    
}

function deleteMedicine($pdo, $medicine_id) {
    $sql = $pdo->prepare("DELETE FROM medicines WHERE id = ? AND user_id = ?");
    $sql->execute([$medicine_id,$_SESSION['logged']['id']]);
    $medicines = $sql->fetch();
    if (!empty($medicines)) {
        header("Location: ../account");
        die();
    } else {
        header("Location: ../account");
        die();
    }
}

function showAll($pdo) {
    $user_id = implode([$_SESSION['logged']['id']]);
    $sql = $pdo->prepare("SELECT * FROM medicines WHERE user_id = ?");
    $sql->execute([$user_id]);
    $medicines = $sql->fetchAll();
    require("../views/medicine/view.php");

}

function validateForm($input_name, $input_dosage, $input_unit, $input_frequency) {
    if (isset($_POST['name'],$_POST['dosage'],$_POST['dosage_unit'],$_POST['frequency'])) {
        $error_messages = [];
        $valid_values = [];

        //name
        if (!preg_match('/[0-9]/', $input_name) && strlen($input_name) <= 25) {
            $valid_values['name'] = ucwords(strtolower($input_name));
        } else {
            $error_messages['name'][] = "The name is not valid! (Only letters)";
        }
        //dosage
        if ($input_dosage >= 1 && $input_dosage <= 1000) {
            $valid_values['dosage_qt'] = ucwords($input_dosage);
        } else {
            $error_messages['dosage_qt'][] = "The dosage is not valid!";
        }
        //dosage_unit
        $units = ['mg','g','ml','unit','tablet','capsule','drop'];
        if (in_array($input_unit, $units)) {
            $valid_values['dosage_unit'] = $input_unit;
        } else {
            $error_messages['dosage_unit'][] = "The dosage unit is not valid!";
        }
        //frequency
        if (strlen($input_frequency) <= 50) {
            $valid_values['frequency'] = htmlspecialchars($input_frequency);
        } else {
            $error_messages['frequency'][] = "The frequency is not valid!";
        }

    } else {
        $error_messages['medicine'][] = "All fields are required.";
    }

    return [
        'errors' => $error_messages,
        'values' => $valid_values
    ];}
?>