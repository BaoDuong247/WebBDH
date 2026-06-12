<?php
require 'app/config/database.php';

$db = (new Database())->getConnection();

$stmt = $db->query('DESCRIBE account');
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Field'] . ' | ' . $row['Type'] . PHP_EOL;
}
