<?php
// 1. Tự động nạp file SessionHelper từ thư mục helpers để toàn hệ thống sử dụng
if (file_exists('app/helpers/SessionHelper.php')) {
    require_once 'app/helpers/SessionHelper.php';
    // Khởi động session thông qua Helper vừa nạp
    SessionHelper::start();
} else {
    session_start(); // Dự phòng nếu chưa có Helper
}

// Nạp model mặc định (nếu cần)
if (file_exists('app/models/ProductModel.php')) {
    require_once 'app/models/ProductModel.php';
}

// 2. Phân tích URL từ hệ thống (.htaccess) để định tuyến (Routing)
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Xác định Controller và Action cơ bản dựa trên URL
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'ProductController';
$hasApiSegment = isset($url[0]) && strtolower($url[0]) === 'api';
$isApiController = preg_match('/ApiController$/', $controllerName) === 1;

if ($hasApiSegment || $isApiController) {
    $action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';
} else {
    $action = isset($url[1]) && $url[1] != '' ? $url[1] : 'list';
}

// ==========================================
// KHỐI XỬ LÝ ĐỊNH TUYẾN API (GIỮ LẠI TỪ INDEX CŨ)
// ==========================================
if ($hasApiSegment && isset($url[1])) {
    $apiControllerName = ucfirst($url[1]) . 'ApiController';
    
    if (file_exists('app/controllers/' . $apiControllerName . '.php')) {
        require_once 'app/controllers/' . $apiControllerName . '.php';
        
        if (!class_exists($apiControllerName)) {
            http_response_code(500);
            echo json_encode(['message' => "API Class $apiControllerName not found."]);
            exit;
        }

        $controller = new $apiControllerName();
        $method = $_SERVER['REQUEST_METHOD'];
        $id = $url[2] ?? null;

        // Khớp HTTP Method với Action tương ứng của API
        switch ($method) {
            case 'GET':
                $action = $id ? 'show' : 'index';
                break;
            case 'POST':
                $action = 'store';
                break;
            case 'PUT':
                $action = $id ? 'update' : 'index';
                break;
            case 'DELETE':
                $action = $id ? 'destroy' : 'index';
                break;
            default:
                http_response_code(405);
                echo json_encode(['message' => 'Method Not Allowed']);
                exit;
        }

        if (method_exists($controller, $action)) {
            if ($id) {
                call_user_func_array([$controller, $action], [$id]);
            } else {
                call_user_func_array([$controller, $action], []); 
            }
        } else {
            http_response_code(444); // Hoặc 404
            echo json_encode(['message' => "Action '$action' not found in $apiControllerName"]);
        }
        exit; // Kết thúc xử lý API tại đây, không chạy xuống phần Web giao diện bên dưới
    } else {
        http_response_code(404);
        echo json_encode(['message' => "API Controller '$apiControllerName' not found."]);
        exit;
    }
}

// ==========================================
// KHỐI XỬ LÝ ĐỊNH TUYẾN WEB GIAO DIỆN (MỚI)
// ==========================================
if (!file_exists('app/controllers/' . $controllerName . '.php')) {
    die('Controller not found: ' . htmlspecialchars($controllerName));
}

require_once 'app/controllers/' . $controllerName . '.php';

if (!class_exists($controllerName)) {
    die('Class not found: ' . htmlspecialchars($controllerName) . '. Vui lòng kiểm tra lại tên Class trong file có viết hoa chữ cái đầu chưa.');
}

$controllerInstance = new $controllerName();

if (!method_exists($controllerInstance, $action)) {
    die('Action not found: ' . htmlspecialchars($action));
}

// Gọi action giao diện và truyền tham số
$params = array_slice($url, 2);
call_user_func_array([$controllerInstance, $action], $params);
?>