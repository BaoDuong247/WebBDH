<?php require './app/views/shares/header.php'; ?>
<?php
$currentCategory = isset($category) && is_object($category)
    ? $category
    : (object) ['id' => 0, 'name' => '', 'description' => ''];
?>

<div class="form-wrapper">

    <div class="form-title">

        Chỉnh sửa danh mục

    </div>

    <form id="edit-category-form"
        method="POST">

        <input type="hidden"
            name="id"
            value="<?php echo (int)($currentCategory->id ?? 0); ?>">

        <div class="form-group">

            <label>Tên danh mục</label>

            <input type="text"
                name="name"
                class="form-control"
                value="<?php echo htmlspecialchars($currentCategory->name ?? ''); ?>"
                required>

        </div>

        <div class="form-group">

            <label>Mô tả</label>

            <textarea name="description"
                class="form-control"
                rows="5"><?php echo htmlspecialchars($currentCategory->description ?? ''); ?></textarea>

        </div>

        <button type="submit"
            class="submit-btn">

            Cập nhật danh mục

        </button>

        <div style="margin-top: 10px; margin-bottom: 15px;">

            <a href="/NguyenDuongBao_0154/Category/list" class="submit-btn" style="display: inline-block; text-decoration: none; text-align: center;">

                ← Quay về trang chủ

            </a>

        </div>

    </form>

</div>

<?php require './app/views/shares/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('edit-category-form');

    if (!form) return;

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const id = document.querySelector('input[name="id"]').value;
        const formData = new FormData(form);
        const payload = {
            name: formData.get('name') || '',
            description: formData.get('description') || ''
        };

        fetch('/NguyenDuongBao_0154/api/category/' + id, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (data && data.message && data.message.toLowerCase().indexOf('success') !== -1) {
                    window.location.href = '/NguyenDuongBao_0154/Category/list';
                } else {
                    alert('Cập nhật danh mục thất bại.');
                }
            })
            .catch(function () {
                alert('Không thể cập nhật danh mục lúc này.');
            });
    });
});
</script>