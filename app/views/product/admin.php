<?php require './app/views/shares/header.php'; ?>

<div class="container" style="max-width: 1200px; margin: 40px auto; padding: 0 20px;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px solid #dfb76c; padding-bottom: 15px;">
        <h2 style="color: #fff; margin: 0; font-size: 24px; letter-spacing: 1px;">
            📦 BỘ SƯU TẬP ĐỒNG HỒ
        <div style="display: flex; gap: 12px; align-items: center;">
            <a href="/NguyenDuongBao_0154/Product/list" style="background-color: transparent; color: #dfb76c; border: 1px solid #dfb76c; padding: 9px 18px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 14px; transition: all 0.2s ease;">
                🔙 Quay về Trang Chủ
            </a>
            <a href="/NguyenDuongBao_0154/Product/add" class="add-btn" style="background-color: #dfb76c; color: #111; padding: 10px 20px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 14px; display: inline-block;">
                + Thêm sản phẩm
            </a>
        </div>
    </div>

    <table class="category-table" style="width: 100%; border-collapse: collapse; margin-top: 10px;">
        <thead>
            <tr>
                <th style="width: 60px; text-align: center;">ID</th>
                <th style="width: 90px; text-align: center;">Hình Ảnh</th>
                <th style="text-align: left;">Tên Sản Phẩm</th>
                <th style="width: 150px; text-align: left;">Danh Mục</th>
                <th style="width: 150px; text-align: right;">Giá Bán</th>
                <th style="text-align: left; max-width: 250px;">Mô Tả</th>
                <th style="width: 160px; text-align: center;">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $index => $product): ?>
                    <?php 
                        // Ép kiểu để tránh lỗi Object/Array hỗn hợp
                        $p = is_object($product) ? $product : (object)$product;
                        $pArr = is_array($product) ? $product : (array)$product;
                        
                        $id = $p->id ?? $pArr['id'] ?? ($index + 1);
                        $name = $p->name ?? $pArr['name'] ?? "Chưa có tên";
                        $desc = $p->description ?? $pArr['description'] ?? "Không có mô tả";
                        $price = $p->price ?? $pArr['price'] ?? 0;
                        $catName = $p->category_name ?? $pArr['category_name'] ?? 'Chưa có';
                        $img = $p->image ?? $pArr['image'] ?? null;

                        // Xử lý đường dẫn ảnh đồng bộ với trang chủ
                        $cleanImg = !empty($img) ? trim($img) : ''; 
                        if (strpos($cleanImg, 'public/') !== false) {
                            $imgPath = "/NguyenDuongBao_0154/" . $cleanImg;
                        } else {
                            $imgPath = "/NguyenDuongBao_0154/public/images/" . $cleanImg;
                        }
                    ?>
                    <tr>
                        <td style="text-align: center; font-weight: bold; color: #dfb76c;"><?php echo htmlspecialchars($id); ?></td>
                        <td style="text-align: center; padding: 8px;">
                            <div style="width: 50px; height: 50px; background: #222; border: 1px solid #333; border-radius: 4px; overflow: hidden; display: inline-flex; align-items: center; justify-content: center;">
                                <?php if (!empty($cleanImg)): ?>
                                    <img src="<?php echo htmlspecialchars($imgPath); ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1547996160-81dfa63595aa?q=80&w=200';">
                                <?php else: ?>
                                    <img src="https://images.unsplash.com/photo-1547996160-81dfa63595aa?q=80&w=200" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php endif; ?>
                            </div>
                        </td>
                        <td style="font-weight: bold; color: #fff; text-align: left;"><?php echo htmlspecialchars($name); ?></td>
                        <td style="color: #aaa; text-align: left;"><?php echo htmlspecialchars($catName); ?></td>
                        <td style="color: #dfb76c; font-weight: bold; text-align: right;">$<?php echo number_format((float)$price, 0, ',', '.'); ?></td>
                        <td style="color: #ccc; text-align: left; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            <?php echo htmlspecialchars($desc); ?>
                        </td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 6px; justify-content: center;">
                                <a href="/NguyenDuongBao_0154/Product/edit/<?php echo $id; ?>" class="edit-btn" style="background-color: transparent; color: #dfb76c; border: 1px solid #dfb76c; padding: 4px 10px; border-radius: 4px; text-decoration: none; font-size: 13px;">
                                    Sửa
                                </a>
                                <a href="/NguyenDuongBao_0154/Product/delete/<?php echo $id; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')" class="delete-btn" style="background-color: #962d2d; color: #fff; padding: 4px 10px; border-radius: 4px; text-decoration: none; font-size: 13px; border: none;">
                                    Xóa
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="padding: 30px; text-align: center; color: #888; font-style: italic;">
                        Không có sản phẩm nào trong hệ thống.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require './app/views/shares/footer.php'; ?>