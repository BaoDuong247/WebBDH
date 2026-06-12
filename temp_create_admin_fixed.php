<?php
require 'app/config/database.php';

$db = (new Database())->getConnection();

$check = $db->prepare('SELECT id FROM account WHERE username = ?');
$check->execute(['Admin']);

if ($check->fetch()) {
    $stmt = $db->prepare('UPDATE account SET fullname = ?, password = ?, role = ? WHERE username = ?');
    $stmt->execute(['Admin', password_hash('Admin123@', PASSWORD_BCRYPT), 'admin', 'Admin']);
    echo 'UPDATED';
} else {
    $stmt = $db->prepare('INSERT INTO account (username, fullname, password, role) VALUES (?, ?, ?, ?)');
    $stmt->execute(['Admin', 'Admin', password_hash('Admin123@', PASSWORD_BCRYPT), 'admin']);
    echo 'CREATED';
}
