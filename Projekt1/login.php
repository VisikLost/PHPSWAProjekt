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
                <h2 class="mainloginh2">Login</h2>

                <hr>

                <form action="authenticate.php" method="POST">
                    <div class="login-email logindiv">
                        <h3>Username</h3>
                        <input type="text" name="username" placeholder="Enter your Username" required>
                    </div>

                    <div class="login-password logindiv">
                        <h3>Password</h3>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <input type="submit" value="LOGIN" class="submit">

                    <p class="formp">Don't have an account yet?  <a href="register.php">Register</a></p>
                </form>
            </div>
        </main>
    
        <footer>
             <p>Jan Laurenčík &copy; 2024</p>
        </footer>
    </div>

</body>
</html>