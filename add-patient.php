<?php
session_start();
require "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); exit;
}

$user_id = $_SESSION['user_id'];
$error   = "";

// Fetch wards for dropdown
$wards = $pdo->query("SELECT * FROM wards ORDER BY name")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name          = trim($_POST["name"]);
    $age           = (int)$_POST["age"];
    $gender        = $_POST["gender"];
    $ward_id       = (int)$_POST["ward_id"];
    $diagnosis     = trim($_POST["diagnosis"]);
    $room_number   = trim($_POST["room_number"]);
    $admission_date = $_POST["admission_date"];
    $notes         = trim($_POST["notes"]);

    if (empty($name) || empty($diagnosis) || empty($admission_date) || $age < 1) {
        $error = "Name, age, diagnosis and admission date are required.";
    } elseif (!in_array($gender, ['Male','Female','Other'])) {
        $error = "Please select a valid gender.";
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO patients (user_id, ward_id, name, age, gender, diagnosis, room_number, admission_date, notes)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([$user_id, $ward_id, $name, $age, $gender, $diagnosis, $room_number, $admission_date, $notes]);
        header("Location: dashboard.php"); exit;
    }
}

include "add-patient-form.php";
