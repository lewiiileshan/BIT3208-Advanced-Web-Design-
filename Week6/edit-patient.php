<?php
require "db.php";

$error = "";
$id    = (int)($_GET['id'] ?? 0);

if ($id < 1) {
    header("Location: dashboard.php"); exit;
}

$stmt = $pdo->prepare("SELECT * FROM patients WHERE id = ?");
$stmt->execute([$id]);
$patient = $stmt->fetch();

if (!$patient) {
    header("Location: dashboard.php"); exit;
}

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
    $status         = $_POST["status"];

    if (empty($name) || empty($diagnosis) || empty($admission_date) || $age < 1) {
        $error = "Name, age, diagnosis and admission date are required.";
    } elseif (!in_array($gender, ['Male','Female','Other'])) {
        $error = "Please select a valid gender.";
    } elseif (!in_array($status, ['Admitted','Discharged'])) {
        $error = "Invalid status.";
    } else {
        $discharge_date = $status === 'Discharged' ? date('Y-m-d') : null;

        $stmt = $pdo->prepare(
            "UPDATE patients
             SET name=?, age=?, gender=?, ward_id=?, diagnosis=?,
                 room_number=?, admission_date=?, notes=?, status=?, discharge_date=?
             WHERE id=?"
        );
        $stmt->execute([
            $name, $age, $gender, $ward_id, $diagnosis,
            $room_number, $admission_date, $notes, $status, $discharge_date,
            $id
        ]);
        header("Location: dashboard.php"); exit;
    }

    $patient = array_merge($patient, $_POST);
}

include "edit-patient-form.php";
