<?php require './app/views/shares/header.php'; ?>

<div style="max-width: 480px; margin: 60px auto; padding: 40px; background: #111; border: 1px solid #dfb76c; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); font-family: sans-serif; color: #fff;">
    <h2 style="text-align: center; color: #dfb76c; margin-bottom: 25px; letter-spacing: 1px;">📝 ĐĂNG KÝ HỆ THỐNG</h2>
    
    <?php if(!empty($errors)): ?>
        <div style="background: rgba(231, 76, 60, 0.2); border: 1px solid #e74c3c; color: #e74c3c; padding: 12px; border-radius: 4px; margin-bottom: 20px; font-size: 14px;">
            <?php foreach($errors as $error) echo '• ' . htmlspecialchars($error) . '<br>'; ?>
        </div>
    <?php endif; ?>

    <form action="/NguyenDuongBao_0154/Account/save" method="POST">
        <div style="margin-bottom: 18px;">
            <label style="display: block; margin-bottom: 8px; color: #aaa; font-size: 14px;">Tên đăng nhập (Username)</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>" style="width: 100%; padding: 11px; background: #222; border: 1px solid #444; border-radius: 4px; color: #fff; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 18px;">
            <label style="display: block; margin-bottom: 8px; color: #aaa; font-size: 14px;">Họ và tên (Full Name)</label>
            <input type="text" name="fullname" value="<?php echo htmlspecialchars($fullName ?? ''); ?>" style="width: 100%; padding: 11px; background: #222; border: 1px solid #444; border-radius: 4px; color: #fff; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 18px;">
            <label style="display: block; margin-bottom: 8px; color: #aaa; font-size: 14px;">Số điện thoại</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($phone ?? ''); ?>" style="width: 100%; padding: 11px; background: #222; border: 1px solid #444; border-radius: 4px; color: #fff; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 18px;">
            <label style="display: block; margin-bottom: 8px; color: #aaa; font-size: 14px;">Địa chỉ</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($address ?? ''); ?>" style="width: 100%; padding: 11px; background: #222; border: 1px solid #444; border-radius: 4px; color: #fff; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 18px;">
            <label style="display: block; margin-bottom: 8px; color: #aaa; font-size: 14px;">Mật khẩu</label>
            <input type="password" name="password" style="width: 100%; padding: 11px; background: #222; border: 1px solid #444; border-radius: 4px; color: #fff; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 22px;">
            <label style="display: block; margin-bottom: 8px; color: #aaa; font-size: 14px;">Xác nhận mật khẩu</label>
            <input type="password" name="confirmpassword" style="width: 100%; padding: 11px; background: #222; border: 1px solid #444; border-radius: 4px; color: #fff; box-sizing: border-box;">
        </div>

        <button type="submit" style="width: 100%; padding: 13px; background: #dfb76c; color: #111; border: none; border-radius: 4px; font-weight: bold; font-size: 16px; cursor: pointer; transition: opacity 0.2s;">
            Tạo Tài Khoản
        </button>
    </form>

    <div style="margin-top: 25px; text-align: center; font-size: 14px; color: #aaa;">
        Đã có tài khoản rồi? <a href="/NguyenDuongBao_0154/Account/login" style="color: #dfb76c; text-decoration: none; font-weight: bold;">Đăng nhập tại đây</a>
    </div>
</div>

<?php require './app/views/shares/footer.php'; ?>