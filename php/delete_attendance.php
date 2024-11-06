<?php
include 'config.php';
session_start();

if ($_SESSION['role'] == 'admin' && isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM attendance WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: admin_dashboard.php");
}
?>
