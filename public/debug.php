<?php
// Allow direct access for testing
require_once('app/config/database.php');

try {
    $db = (new Database())->getConnection();
    
    // Check all accounts
    $query = "SELECT id, username, fullname, role, password FROM account";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "=== All Accounts ===\n";
    foreach ($accounts as $acc) {
        echo "ID: {$acc['id']}, Username: {$acc['username']}, Fullname: {$acc['fullname']}, Role: {$acc['role']}\n";
        echo "Password Hash: {$acc['password']}\n\n";
    }
    
    // Check if Admin exists and test password
    $query = "SELECT * FROM account WHERE username = 'Admin'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "=== Admin Account Check ===\n";
    if ($admin) {
        echo "Admin account found!\n";
        echo "Username: {$admin['username']}\n";
        echo "Fullname: {$admin['fullname']}\n";
        echo "Role: {$admin['role']}\n";
        echo "Password Hash: {$admin['password']}\n";
        
        // Test password verification
        $testPassword = "Admin123@";
        $isValid = password_verify($testPassword, $admin['password']);
        echo "Password 'Admin123@' verification: " . ($isValid ? "✓ VALID" : "✗ INVALID") . "\n";
    } else {
        echo "Admin account NOT found in database\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
