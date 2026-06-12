<?php require './app/views/shares/header.php'; ?>
<?php
$currentCategory = isset($category) && is_object($category)
    ? $category
    : (object) ['id' => 0, 'name' => 'Không có tên', 'description' => 'Chưa có mô tả cho danh mục này.'];
?>

<section style="padding: 60px 20px; max-width: 960px; margin: 0 auto; min-height: 600px; box-sizing: border-box; color: #fff;">
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 24px;">
        <div>
            <h1 style="font-size: 30px; font-weight: bold; color: #fff; margin-bottom: 8px;">Chi tiết danh mục</h1>
            <p style="color: #ccc; margin: 0;">Xem thông tin danh mục và quay lại quản lý danh mục.</p>
        </div>
        <a href="/NguyenDuongBao_0154/Category/list" style="background: #dfb76c; color: #111; text-decoration: none; padding: 10px 16px; border-radius: 6px; font-weight: bold;">← Quay lại</a>
    </div>

    <div style="background: #1a1a1a; border: 1px solid #2d2d2d; border-radius: 12px; padding: 24px; box-shadow: 0 12px 40px rgba(0,0,0,0.45);">
        <div style="display: flex; flex-wrap: wrap; gap: 16px; margin-bottom: 12px; align-items: baseline;">
            <span style="display: inline-block; background: #2a2a2a; color: #dfb76c; padding: 6px 10px; border-radius: 999px; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">ID: <?php echo (int)($currentCategory->id ?? 0); ?></span>
            <h2 style="margin: 0; font-size: 24px; color: #fff;"><?php echo htmlspecialchars($currentCategory->name ?? 'Không có tên'); ?></h2>
        </div>
        <p style="color: #ddd; line-height: 1.7; margin: 0; min-height: 80px;">
            <?php echo nl2br(htmlspecialchars($currentCategory->description ?? 'Chưa có mô tả cho danh mục này.')); ?>
        </p>

        <div style="display: flex; gap: 10px; margin-top: 24px; flex-wrap: wrap;">
            <a href="/NguyenDuongBao_0154/Category/edit/<?php echo (int)($currentCategory->id ?? 0); ?>" style="background: transparent; color: #dfb76c; border: 1px solid #dfb76c; text-decoration: none; padding: 10px 14px; border-radius: 6px; font-weight: bold;">✏ Sửa danh mục</a>
            <button type="button" onclick="deleteCategory(<?php echo (int)($currentCategory->id ?? 0); ?>)" style="background: #962d2d; color: #fff; border: none; text-decoration: none; padding: 10px 14px; border-radius: 6px; font-weight: bold; cursor: pointer;">🗑 Xóa danh mục</button>
        </div>
    </div>
</section>

<?php require './app/views/shares/footer.php'; ?>

<script>
function deleteCategory(id) {
    if (!confirm('Bạn có chắc muốn xóa danh mục này?')) return;

    fetch('/NguyenDuongBao_0154/api/category/' + id, {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' }
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            if (data && data.message && data.message.toLowerCase().indexOf('success') !== -1) {
                window.location.href = '/NguyenDuongBao_0154/Category/list';
            } else {
                alert('Xóa danh mục thất bại.');
            }
        })
        .catch(function () {
            alert('Không thể xóa danh mục lúc này.');
        });
}
</script>
