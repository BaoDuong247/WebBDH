<?php 
// Khởi động session ở ngay đầu file nếu chưa có
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('app/config/database.php'); 
require_once('app/models/AccountModel.php'); 

class AccountController { 
    private $accountModel; 
    private $db; 

    public function __construct() { 
        $this->db = (new Database())->getConnection(); 
        $this->accountModel = new AccountModel($this->db); 
    } 

    public function register() { 
        $errors = [];
        include_once 'app/views/account/register.php'; 
    } 

    public function login() { 
        $errors = [];
        include_once 'app/views/account/login.php'; 
    } 

    public function save() { 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $username = $_POST['username'] ?? ''; 
            $fullName = $_POST['fullname'] ?? ''; 
            $password = $_POST['password'] ?? ''; 
            $confirmPassword = $_POST['confirmpassword'] ?? ''; 
            $role = $_POST['role'] ?? 'user'; 
            
            $errors = []; 
            if (empty($username)) $errors['username'] = "Vui lòng nhập username!"; 
            if (empty($fullName)) $errors['fullname'] = "Vui lòng nhập fullname!"; 
            if (empty($password)) $errors['password'] = "Vui lòng nhập password!"; 
            if ($password != $confirmPassword) $errors['confirmPass'] = "Mật khẩu và xác nhận chưa khớp!"; 
            if (!in_array($role, ['admin', 'user'])) $role = 'user'; 

            if ($this->accountModel->getAccountByUsername($username)) { 
                $errors['account'] = "Tài khoản này đã được đăng ký!"; 
            } 

            if (count($errors) > 0) { 
                include_once 'app/views/account/register.php'; 
                return;
            } else { 
                $result = $this->accountModel->save($username, $fullName, $password, $role); 
                if ($result) {
                    echo "<script>alert('Đăng ký thành công!'); window.location.href='/NguyenDuongBao_0154/Account/login';</script>";
                    exit;
                } else {
                    $errors['account'] = "Đăng ký thất bại, vui lòng thử lại!";
                    include_once 'app/views/account/register.php';
                    return;
                }
            } 
        } 
    } 

    public function checkLogin() { 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $errors = [];
            if (empty($username)) $errors['username'] = "Vui lòng nhập tài khoản!";
            if (empty($password)) $errors['password'] = "Vui lòng nhập mật khẩu!";
            
            if (count($errors) > 0) {
                include_once 'app/views/account/login.php';
                return;
            }
            
            $account = $this->accountModel->getAccountByUsername($username);
            
            if ($account && password_verify($password, $account->password)) {
                // Đăng nhập thành công, lưu session động
                $_SESSION['username'] = $account->username;
                $_SESSION['fullname'] = $account->fullname;
                $_SESSION['role'] = $account->role;
                
                header('Location: /NguyenDuongBao_0154/Product/list');
                exit;
            } else {
                $errors['login'] = "Tài khoản hoặc mật khẩu không chính xác!";
                include_once 'app/views/account/login.php';
                return;
            }
        }
    }

    public function logout() { 
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['username']); 
        unset($_SESSION['fullname']); 
        unset($_SESSION['role']); 
        header('Location: /NguyenDuongBao_0154/Product/list'); 
        exit; 
    } 
} 
?>