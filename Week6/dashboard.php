<?php
require "db.php";

// Handle discharge
if (isset($_GET['discharge'])) {
    $stmt = $pdo->prepare("UPDATE patients SET status='Discharged', discharge_date=CURDATE() WHERE id=?");
    $stmt->execute([(int)$_GET['discharge']]);
    header("Location: dashboard.php"); exit;
}

// Handle delete
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM patients WHERE id=?");
    $stmt->execute([(int)$_GET['delete']]);
    header("Location: dashboard.php"); exit;
}

// Fetch all patients
$patients = $pdo->query(
    "SELECT p.*, w.name AS ward_name
     FROM patients p
     JOIN wards w ON p.ward_id = w.id
     ORDER BY p.admission_date DESC"
)->fetchAll();

$total      = count($patients);
$admitted   = count(array_filter($patients, fn($p) => $p['status'] === 'Admitted'));
$discharged = count(array_filter($patients, fn($p) => $p['status'] === 'Discharged'));

include "dashboard-page.php";
