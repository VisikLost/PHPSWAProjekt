<?php
$hashedPassword = password_hash('skola123', PASSWORD_DEFAULT);
echo $hashedPassword;
?>

<br>
<br>


$2y$10$9.fVDNLFKVpW6kNRVx7AZOrWXoEEc4aaWk/tYMQjjKfRZoc6bdQDS (skola123)
$2y$10$.iGXXiThpE6cyak03I0QveM9zwdWsLd9zcvGu6F7C/pIl5qT06HXK (mojeHeslokPHPMYADMIN)

databaze user_management

tabulka:

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

admin:

INSERT INTO users (username, password, role) 
VALUES ('admin', '$2y$10$9.fVDNLFKVpW6kNRVx7AZOrWXoEEc4aaWk/tYMQjjKfRZoc6bdQDS', 'admin');

(Uprostřed hashlé skola123) 

vytvoření tabulky pro books

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    is_borrowed BOOLEAN DEFAULT 0,
    borrowed_at DATETIME DEFAULT NULL,
    borrowed_by INT DEFAULT NULL,
    FOREIGN KEY (borrowed_by) REFERENCES users(id) ON DELETE SET NULL
);

vytvoření knih

INSERT INTO books (title, is_borrowed, borrowed_at, borrowed_by) VALUES
('Krakatit', 0, NULL, NULL),
('Saturnin', 0, NULL, NULL),
('Osudy dobrého vojáka Švejka', 0, NULL, NULL),
('Kytice', 0, NULL, NULL),
('Babička', 0, NULL, NULL),
('Pohádky K. J. Erbena', 0, NULL, NULL);