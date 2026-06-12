<?php
require 'app/config/database.php';
require 'app/models/AccountModel.php';

$db = (new Database())->getConnection();
$model = new AccountModel($db);

if ($model->getAccountByUsername('Admin')) {
    echo "EXISTS";
} else {
    $ok = $model->save('Admin', 'Admin', '', '', 'Admin123@', 'admin');
    echo $ok ? 'CREATED' : 'FAILED';
}
