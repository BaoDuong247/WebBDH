<?php
// 1. Tự động nạp file SessionHelper từ thư mục helpers để toàn hệ thống sử dụng
if (file_exists('app/helpers/SessionHelper.php')) {
    require_once 'app/helpers/SessionHelper.php';
}

// Khởi động session thông qua Helper vừa nạp thay cho session_start() thủ công
SessionHelper::start();

// Nạp model mặc định
require_once 'app/models/ProductModel.php';

// 2. Phân tích URL từ hệ thống (.htaccess) để định tuyến (Routing)
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Thay đổi trang mặc định từ DefaultController thành ProductController khi URL trống
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'ProductController';

// Thay đổi hành động mặc định từ index thành list để hiển thị danh sách sản phẩm ngay từ đầu
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'list';

// Kiểm tra xem file controller có tồn tại thực tế hay không
if (!file_exists('app/controllers/' . $controllerName . '.php')) {
    die('Controller not found: ' . htmlspecialchars($controllerName));
}

// Nạp file Controller tương ứng
require_once 'app/controllers/' . $controllerName . '.php';

// Kiểm tra xem Class tương ứng có tồn tại bên trong file vừa require không
if (!class_exists($controllerName)) {
    die('Class not found: ' . htmlspecialchars($controllerName) . '. Vui lòng kiểm tra lại tên Class trong file có viết hoa chữ cái đầu chưa.');
}

// Khởi tạo Controller
$controllerInstance = new $controllerName();

// Kiểm tra xem phương thức (Action) có tồn tại trong Controller không
if (!method_exists($controllerInstance, $action)) {
    die('Action not found: ' . htmlspecialchars($action));
}

// 3. Gọi action và truyền các tham số còn lại phía sau nếu có (Ví dụ: ID sản phẩm khi xem/sửa/xóa)
$params = array_slice($url, 2);
call_user_func_array([$controllerInstance, $action], $params);
?>