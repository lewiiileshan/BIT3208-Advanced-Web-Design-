<?php
require "db.php";

$error = "";

$wards = $pdo->query("SELECT * FROM wards ORDER BY name")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name           = trim($_POST["name"]);
    $age            = (int)$_POST["age"];
    $gender         = $_POST["gender"];
    $ward_id        = (int)$_POST["ward_id"];
    $diagnosis      = trim($_POST["diagnosis"]);
    $room_number    = trim($_POST["room_number"]);
    $admission_date = $_POST["admission_date"];
    $notes          = trim($_POST["notes"]);

    if (empty($name) || empty($diagnosis) || empty($admission_date) || $age < 1) {
        $error = "Name, age, diagnosis and admission date are required.";
    } elseif (!in_array($gender, ['Male','Female','Other'])) {
        $error = "Please select a valid gender.";
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO patients (ward_id, name, age, gender, diagnosis, room_number, admission_date, notes)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([$ward_id, $name, $age, $gender, $diagnosis, $room_number, $admission_date, $notes]);
        header("Location: dashboard.php"); exit;
    }
}

include "add-patient-form.php";
