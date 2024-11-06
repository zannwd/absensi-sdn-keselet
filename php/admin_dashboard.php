<?php
include 'config.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$stmt = $conn->query("SELECT attendance.id, users.username, attendance.teacher_name, attendance.entry_date, attendance.entry_time, attendance.exit_time, attendance.status FROM attendance JOIN users ON attendance.user_id = users.id");
$attendanceRecords = $stmt->fetchAll();
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
<h2>Dashboard Admin</h2>
<a href="logout.php">Logout</a> | <a href="php/download_excel.php">Unduh Excel</a> | <a href="php/download_pdf.php">Unduh PDF</a>

<table border="1">
    <tr>
        <th>Username</th>
        <th>Nama Guru</th>
        <th>Tanggal Masuk</th>
        <th>Jam Masuk</th>
        <th>Jam Keluar</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($attendanceRecords as $record): ?>
    <tr>
        <td><?= $record['username'] ?></td>
        <td><?= $record['teacher_name'] ?></td>
        <td><?= $record['entry_date'] ?></td>
        <td><?= $record['entry_time'] ?></td>
        <td><?= $record['exit_time'] ?></td>
        <td><?= $record['status'] ?></td>
        <td><a href="delete_attendance.php?id=<?= $record['id'] ?>">Hapus</a></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>