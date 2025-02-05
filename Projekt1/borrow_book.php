<?php
session_start();
include 'db.php'; // Database connection

// Ensure user is logged in
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] === 'admin') {
    header('Location: authenticate.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user']['id'];
    $bookId = intval($_POST['book_id']);

    // Check if the book is already borrowed
    $stmt = $pdo->prepare('SELECT * FROM books WHERE id = ? AND is_borrowed = 0');
    $stmt->execute([$bookId]);
    $book = $stmt->fetch();

    if ($book) {
        // Borrow the book by updating the book details
        $stmt = $pdo->prepare('
            UPDATE books 
            SET is_borrowed = 1, borrowed_by = ?, borrowed_at = NOW() 
            WHERE id = ?');
        $stmt->execute([$userId, $bookId]);

        header('Location: user_dashboard.php');
        exit;
    } else {
        echo "This book is already borrowed.";
    }
}
?>