<?php
session_start();
include 'db.php'; // Database connection

// Ensure user is logged in
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] === 'admin') {
    header('Location: authenticate.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = intval($_POST['book_id']);

    // Update the book to mark it as returned
    $stmt = $pdo->prepare('
        UPDATE books 
        SET is_borrowed = 0, borrowed_by = NULL, borrowed_at = NULL 
        WHERE id = ?');
    $stmt->execute([$bookId]);

    header('Location: user_vypujcky.php');
    exit;
}
?>