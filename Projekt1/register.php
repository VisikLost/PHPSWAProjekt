<?php
session_start();
include 'db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = 'user'; // All new users will be regular users

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username already exists
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        echo "Username already taken. Please choose a different one.";
    } else {
        // Insert the new user into the database
        $stmt = $pdo->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, ?)');
        $stmt->execute([$username, $hashedPassword, $role]);

        echo "Registration successful! You can now <a href='authenticate.php'>log in</a>.";
    }
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
                    <li><a href="index.php">Knihovna</a></li>
                </ul>
        
                <ul class="right-header">
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
            </div>
        </header>
    
        <main>
            <div id=main-login>
                <h2 class="mainloginh2">Sign In</h2>

                <hr>

                <form method="POST" action="">
                    <div class="login-email logindiv">
                        <h3>Username</h3>
                        <input type="text" name="username" id="username" placeholder="Enter your email" required>
                    </div>

                    <div class="login-password logindiv">
                        <h3>Password</h3>
                        <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    </div>

                    <input type="submit" value="SIGNUP" class="submit">

                    <p class="formp">Already have an account?  <a href="login.php">Login</a></p>
                </form>
            </div>
        </main>
    
        <footer>
             <p>Jan Laurenčík &copy; 2024</p>
        </footer>
    </div>