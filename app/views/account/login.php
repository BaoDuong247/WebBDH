<?php require './app/views/shares/header.php'; ?>

<div style="max-width: 420px; margin: 90px auto; padding: 40px; background: #111; border: 1px solid #dfb76c; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); font-family: sans-serif; color: #fff;">
    <h2 style="text-align: center; color: #dfb76c; margin-bottom: 30px; letter-spacing: 1px;">🔑 ĐĂNG NHẬP</h2>
    
    <?php if(!empty($errors)): ?>
        <div style="background: rgba(231, 76, 60, 0.2); border: 1px solid #e74c3c; color: #e74c3c; padding: 12px; border-radius: 4px; margin-bottom: 20px; font-size: 14px; text-align: center;">
            <?php foreach($errors as $error) echo htmlspecialchars($error) . '<br>'; ?>
        </div>
    <?php endif; ?>

    <form action="/NguyenDuongBao_0154/Account/checkLogin" method="POST">
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; color: #aaa; font-size: 14px;">Tên đăng nhập</label>
            <input type="text" name="username" required style="width: 100%; padding: 12px; background: #222; border: 1px solid #444; border-radius: 4px; color: #fff; box-sizing: border-box; font-size: 15px;">
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; margin-bottom: 8px; color: #aaa; font-size: 14px;">Mật khẩu</label>
            <input type="password" name="password" required style="width: 100%; padding: 12px; background: #222; border: 1px solid #444; border-radius: 4px; color: #fff; box-sizing: border-box; font-size: 15px;">
        </div>

        <button type="submit" style="width: 100%; padding: 14px; background: #dfb76c; color: #111; border: none; border-radius: 4px; font-weight: bold; font-size: 16px; cursor: pointer;">
            Đăng Nhập
        </button>
    </form>

    <div style="margin-top: 25px; text-align: center; font-size: 14px; color: #aaa;">
        Thành viên mới? <a href="/NguyenDuongBao_0154/Account/register" style="color: #dfb76c; text-decoration: none; font-weight: bold;">Đăng ký tài khoản</a>
    </div>
</div>

<?php require './app/views/shares/footer.php'; ?>