<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: authenticate.php');
    exit;
}

require 'db.php';

$borrowedBooksQuery = $pdo->query("SELECT * FROM books WHERE is_borrowed = 1");
$borrowedBooks = $borrowedBooksQuery->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['force_return_book_id'])) {
    $forceReturnBookId = $_POST['force_return_book_id'];

    $pdo->prepare("UPDATE books SET is_borrowed = 0, borrowed_by = NULL WHERE id = ?")
        ->execute([$forceReturnBookId]);

    header('Location: admin_vypujcky.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Knihovna</title>
</head>
<body>
    <div id="web">
        <header>
            <div id="header-div">
                <ul class="left-header">
                    <li><a href="admin_dashboard.php">Knihovna</a></li>
                </ul>

                <ul class="right-header">
                    <li><h2 class="acc-name">ADMIN</h2></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </header>
    
        <main>
            <div id="main-div">
                <section id="main-left">
                    <ul>
                        <li><a href="admin_dashboard.php">Knihy</a></li>
                        <li><a href="admin_vypujcky.php">Výpujčky</a></li>
                    </ul>
                </section>
        
                <section id="main-right">
                    <h3>Seznam vypůjčených knih</h3>
                    <ul>
                        <?php if (count($borrowedBooks) > 0): ?>
                            <?php foreach ($borrowedBooks as $book): ?>
                                <li>
                                    Kniha: <strong><?= htmlspecialchars($book['title']) ?></strong> |
                                    Id Uživatele: <?= htmlspecialchars($book['borrowed_by']) ?> |
                                    Datum vypůjčení: <?= $book['borrowed_at'] ?> |
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="force_return_book_id" value="<?= $book['id'] ?>">
                                        <button type="submit" style="Font-Size: 20px; Padding: 5px; Font-weight: bold; background-color:rgb(240, 240, 240); border: 3px solid black; transition: 0.2s; cursor: pointer;"
                                        onmouseover="this.style.backgroundColor='#2ecc71';"
                                        onmouseout="this.style.backgroundColor='rgb(240, 240, 240)';">Vrátit</button>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>Žádné aktuální výpůjčky.</li>
                        <?php endif; ?>
                    </ul>
                </section>
            </div>
        </main>
    
        <footer>
             <p>Jan Laurenčík &copy; 2024</p>
        </footer>
    </div>

</body>
</html>
