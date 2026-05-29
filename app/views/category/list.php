<?php require './app/views/shares/header.php'; ?>

<header class="header">
    <div class="logo">⌚ LUXURY WATCH</div>
    <nav class="nav">
        <a href="/NguyenDuongBao_0154/Product/list">Trang chủ</a>
        <a href="/NguyenDuongBao_0154/Product/list#featured">Nổi bật</a>
        <a href="/NguyenDuongBao_0154/Category/list" class="active" style="color: #dfb76c; font-weight: bold;">Quản lý danh mục</a>
        <a href="/NguyenDuongBao_0154/Product/list#products">Quản lý sản phẩm</a>
        <a href="/NguyenDuongBao_0154/Product/cart">🛒 Giỏ hàng</a>
    </nav>
    <a class="add-btn" href="/NguyenDuongBao_0154/Category/add" style="background-color: #dfb76c; color: #111; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px;">+ Thêm danh mục</a>
</header>

<section style="padding: 60px 20px; max-width: 1200px; margin: 0 auto; min-height: 700px; box-sizing: border-box;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #dfb76c; padding-bottom: 15px;">
        <h1 style="font-size: 32px; font-weight: bold; color: #fff; margin: 0;">📦 QUẢN LÝ DANH MỤC</h1>
        <span style="color: #888; font-size: 14px;">Tổng số: <?php echo count($categories); ?> danh mục</span>
    </div>

    <div style="background: #111; border: 1px solid #2d2d2d; border-radius: 12px; padding: 18px; margin-bottom: 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.35);">
        <div style="font-size: 17px; font-weight: bold; color: #dfb76c; margin-bottom: 12px;">➕ Thêm danh mục mới</div>
        <form method="POST" action="/NguyenDuongBao_0154/Category/save" style="display: grid; grid-template-columns: 1fr 1.4fr auto; gap: 10px; align-items: end;">
            <div>
                <label style="display: block; color: #fff; font-size: 13px; margin-bottom: 6px;">Tên danh mục</label>
                <input type="text" name="name" required style="width: 100%; padding: 10px 12px; border-radius: 6px; border: 1px solid #444; background: #1a1a1a; color: #fff; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; color: #fff; font-size: 13px; margin-bottom: 6px;">Mô tả</label>
                <input type="text" name="description" style="width: 100%; padding: 10px 12px; border-radius: 6px; border: 1px solid #444; background: #1a1a1a; color: #fff; box-sizing: border-box;">
            </div>
            <button type="submit" style="background: #dfb76c; color: #111; border: none; border-radius: 6px; padding: 10px 16px; font-weight: bold; cursor: pointer;">Thêm</button>
        </form>
    </div>

    <div style="background: #1a1a1a; border-radius: 12px; overflow: hidden; box-shadow: 0 12px 40px rgba(0,0,0,0.5); border: 1px solid #2d2d2d;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-family: sans-serif; color: #fff;">
            <thead>
                <tr style="background-color: #111; border-bottom: 2px solid #dfb76c;">
                    <th style="padding: 18px 20px; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; color: #dfb76c; width: 80px; text-align: center;">ID</th>
                    <th style="padding: 18px 20px; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; color: #dfb76c; width: 250px;">Tên Danh Mục</th>
                    <th style="padding: 18px 20px; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; color: #dfb76c;">Mô Tả Chi Tiết</th>
                    <th style="padding: 18px 20px; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; color: #dfb76c; width: 180px; text-align: center;">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $index => $category): ?>
                        <?php 
                            // Ép kiểu dữ liệu linh hoạt để nhận diện cả Object và Array từ Database
                            $cat = is_object($category) ? $category : (object)$category; 
                            $catArr = is_array($category) ? $category : (array)$category;

                            $id = $cat->id ?? $catArr['id'] ?? ($index + 1);
                            $name = $cat->name ?? $catArr['name'] ?? 'Chưa có tên';
                            $description = $cat->description ?? $catArr['description'] ?? 'Không có mô tả';
                        ?>
                        <tr class="table-row" style="border-bottom: 1px solid #2d2d2d; transition: background 0.2s ease;">
                            <td style="padding: 16px 20px; text-align: center; font-weight: bold; color: #dfb76c; background: rgba(0,0,0,0.1);"><?php echo htmlspecialchars($id); ?></td>
                            <td style="padding: 16px 20px; font-weight: 600; color: #fff; font-size: 15px;"><?php echo htmlspecialchars($name); ?></td>
                            <td style="padding: 16px 20px; color: #ccc; font-size: 14px; line-height: 1.5; max-width: 400px; word-wrap: break-word;"><?php echo htmlspecialchars($description); ?></td>
                            <td style="padding: 16px 20px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="/NguyenDuongBao_0154/Category/edit/<?php echo $id; ?>" style="background-color: #333; color: #dfb76c; border: 1px solid #dfb76c; padding: 6px 14px; border-radius: 4px; text-decoration: none; font-size: 13px; font-weight: bold; display: inline-flex; align-items: center; gap: 4px; transition: all 0.2s;">
                                        ✏ Sửa
                                    </a>
                                    <a href="/NguyenDuongBao_0154/Category/delete/<?php echo $id; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này? Các sản phẩm thuộc danh mục cũng có thể bị ảnh hưởng.')" style="background-color: #962d2d; color: #fff; padding: 6px 14px; border-radius: 4px; text-decoration: none; font-size: 13px; font-weight: bold; display: inline-flex; align-items: center; gap: 4px; transition: all 0.2s;">
                                        🗑 Xóa
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="padding: 40px; text-align: center; color: #888; font-style: italic; font-size: 15px;">
                            Hiện tại chưa có danh mục nào trong hệ thống.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<style>
    .table-row:hover {
        background-color: #222222 !important;
    }
    .table-row a:hover {
        opacity: 0.85;
        transform: translateY(-1px);
    }
</style>

<?php require './app/views/shares/footer.php'; ?>