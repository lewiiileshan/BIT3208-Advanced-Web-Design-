<?php
session_start();
require "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); exit;
}

$user_id   = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Handle discharge
if (isset($_GET['discharge'])) {
    $stmt = $pdo->prepare("UPDATE patients SET status = 'Discharged', discharge_date = CURDATE() WHERE id = ? AND user_id = ?");
    $stmt->execute([(int)$_GET['discharge'], $user_id]);
    header("Location: dashboard.php"); exit;
}

// Handle delete
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM patients WHERE id = ? AND user_id = ?");
    $stmt->execute([(int)$_GET['delete'], $user_id]);
    header("Location: dashboard.php"); exit;
}

// Fetch all patients for this user
$stmt = $pdo->prepare("SELECT p.*, w.name AS ward_name FROM patients p JOIN wards w ON p.ward_id = w.id WHERE p.user_id = ? ORDER BY p.admission_date DESC");
$stmt->execute([$user_id]);
$patients = $stmt->fetchAll();

// Stats
$total      = count($patients);
$admitted   = count(array_filter($patients, fn($p) => $p['status'] === 'Admitted'));
$discharged = count(array_filter($patients, fn($p) => $p['status'] === 'Discharged'));

include "dashboard-page.php";
