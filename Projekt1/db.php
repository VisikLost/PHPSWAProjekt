<?php
$host = 'localhost:3306';
$db = 'laurencikj_'; // Replace with your database name
$user = 'laurencikj'; // Replace with your database username
$pass = 'lasgalen1'; // Replace with your database password
$charset = 'utf8mb4';

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>