<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Watch</title>
    <link rel="stylesheet" href="/NguyenDuongBao_0154/public/style.css">
</head>

<body>
    <header class="header">
        <div class="logo">⌚ LUXURY WATCH</div>
        <nav class="nav">
            <a href="/NguyenDuongBao_0154/Product/list">Trang chủ</a>
            <a href="/NguyenDuongBao_0154/Product/cart">🛒 Giỏ hàng</a>
            <?php if (SessionHelper::isAdmin()): ?>
                <a href="/NguyenDuongBao_0154/Product/add" class="add-btn header-add-btn">+ Thêm sản phẩm</a>
                <div class="dropdown" style="display: inline-block; position: relative; padding-bottom: 15px; margin-bottom: -15px;">
                    <a href="#" class="dropdown-toggle" style="cursor: pointer; text-decoration: none;">Quản Lý ▾</a>
                    <div class="dropdown-menu">
                        <a href="/NguyenDuongBao_0154/Category/list">📁 Quản lý danh mục</a>
                        <a href="/NguyenDuongBao_0154/Product/admin">📦 Bộ sưu tập đồng hồ</a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (SessionHelper::isLoggedIn()): ?>
                <span style="color: #dfb76c; margin-left: 15px; font-size: 14px;">
                    👋 Xin chào, <strong><?php echo htmlspecialchars($_SESSION['fullname'] ?? $_SESSION['username']); ?></strong>
                </span>
                <a href="/NguyenDuongBao_0154/Account/logout" style="color: #e74c3c !important; font-size: 14px; margin-left: 10px;">Đăng xuất</a>
            <?php else: ?>
                <a href="/NguyenDuongBao_0154/Account/login" style="border: 1px solid #dfb76c; padding: 5px 12px; border-radius: 4px; color: #dfb76c !important; font-size: 14px; margin-left: 15px; text-decoration: none;">Đăng nhập</a>
            <?php endif; ?>
        </nav>
    </header>