<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: authenticate.php');
    exit;
}

require 'db.php';

$booksQuery = $pdo->query("SELECT * FROM books WHERE is_borrowed = 0");
$books = $booksQuery->fetchAll(PDO::FETCH_ASSOC);
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
                    <h3>Seznam dostupných knih</h3>
                    <ul>
                        <?php foreach ($books as $book): ?>
                            <li>
                                <strong><?= htmlspecialchars($book['title']) ?></strong> - Dostupné
                            </li>
                        <?php endforeach; ?>
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
