<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] === 'admin') {
    header('Location: authenticate.php');
    exit;
}

include 'db.php';

$stmt = $pdo->query('SELECT * FROM books WHERE is_borrowed = 0');
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                    <li><a href="user_dashboard.php">Knihovna</a></li>
                </ul>

                <ul class="right-header">
                    <li><h2 class="acc-name"><?= htmlspecialchars($_SESSION['user']['username']) ?></h2></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </header>
    
        <main>
            <div id="main-div">
                <section id="main-left">
                    <ul>
                        <li><a href="user_dashboard.php">Knihy</a></li>
                        <li><a href="user_vypujcky.php">Výpujčky</a></li>
                    </ul>
                </section>
        
                <section id="main-right">
                    <h2>Dostupné knihy</h2>
                    <ul>
                        <?php foreach ($books as $book): ?>
                            <li>
                                <strong><?= htmlspecialchars($book['title']) ?></strong>
                                <form action="borrow_book.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                                    <button type="submit" style="Font-Size: 20px; Padding: 5px; Font-weight: bold; background-color:rgb(240, 240, 240); border: 3px solid black; transition: 0.2s; cursor: pointer;"
                                        onmouseover="this.style.backgroundColor='#2ecc71';"
                                        onmouseout="this.style.backgroundColor='rgb(240, 240, 240)';">Půjčit</button>
                                </form>
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
