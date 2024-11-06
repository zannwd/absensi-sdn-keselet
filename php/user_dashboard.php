<?php
include 'config.php';
session_start();

if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacher_name = $_POST['teacher_name'];
    $entry_date = $_POST['entry_date'];
    $entry_time = $_POST['entry_time'];
    $exit_time = $_POST['exit_time'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO attendance (user_id, teacher_name, entry_date, entry_time, exit_time, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $teacher_name, $entry_date, $entry_time, $exit_time, $status]);

    echo "Absensi berhasil dicatat.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Dashboard Pengguna</h2>
<form method="POST">
    <label>Nama Guru:</label>
    <input type="text" name="teacher_name" required><br>
    <label>Tanggal Masuk:</label>
    <input type="date" name="entry_date" required><br>
    <label>Jam Masuk:</label>
    <input type="time" name="entry_time" required><br>
    <label>Jam Keluar:</label>
    <input type="time" name="exit_time" required><br>
    <label>Status Kehadiran:</label>
    <select name="status" required>
        <option value="Hadir">Hadir</option>
        <option value="Tidak Hadir">Tidak Hadir</option>
    </select>
    <button type="submit">Simpan Absensi</button>
</form>
<a href="logout.php">Logout</a>

</body>
</html>