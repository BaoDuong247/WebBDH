<?php
require_once('app/config/database.php');

$db = (new Database())->getConnection();

// Check all accounts
$query = "SELECT id, username, fullname, role, password FROM account";
$stmt = $db->prepare($query);
$stmt->execute();
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Accounts in Database:</h2>";
echo "<pre>";
print_r($accounts);
echo "</pre>";

// Check if Admin exists
$query = "SELECT * FROM account WHERE username = 'Admin'";
$stmt = $db->prepare($query);
$stmt->execute();
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<h2>Admin Account:</h2>";
if ($admin) {
    echo "Admin found!<br>";
    echo "Username: " . $admin['username'] . "<br>";
    echo "Password hash: " . $admin['password'] . "<br>";
    
    // Test password verification
    $testPassword = "Admin123@";
    $isValid = password_verify($testPassword, $admin['password']);
    echo "Password verification for 'Admin123@': " . ($isValid ? "VALID" : "INVALID") . "<br>";
} else {
    echo "Admin account not found!<br>";
}
?>
