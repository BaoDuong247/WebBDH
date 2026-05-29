<?php
session_start();
require_once 'app/models/ProductModel.php';

$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// ĐÃ SỬA: Thay đổi trang mặc định từ DefaultController thành ProductController khi URL trống
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'ProductController';

// ĐÃ SỬA: Thay đổi hành động mặc định từ index thành list để hiển thị danh sách sản phẩm ngay từ đầu
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'list';

// Kiểm tra xem file controller có tồn tại thực tế hay không
if (!file_exists('app/controllers/' . $controllerName . '.php')) {
    die('Controller not found: ' . htmlspecialchars($controllerName));
}

require_once 'app/controllers/' . $controllerName . '.php';

// Kiểm tra xem Class tương ứng có tồn tại bên trong file vừa require không
if (!class_exists($controllerName)) {
    die('Class not found: ' . htmlspecialchars($controllerName) . '. Vui lòng kiểm tra lại tên Class trong file có viết hoa chữ cái đầu chưa.');
}

$controller = new $controllerName();

if (!method_exists($controller, $action)) {
    die('Action not found: ' . htmlspecialchars($action));
}

// Gọi action với các tham số còn lại (nếu có)
call_user_func_array([$controller, $action], array_slice($url, 2));