<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'db_almahir';

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset('utf8mb4');
?>