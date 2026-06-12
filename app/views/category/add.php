<?php require './app/views/shares/header.php'; ?>

<div class="form-wrapper">

    <div class="form-title">

        Thêm danh mục

    </div>

    <form id="add-category-form"
        method="POST">

        <div class="form-group">

            <label>Tên danh mục</label>

            <input type="text"
                name="name"
                class="form-control"
                required>

        </div>

        <div class="form-group">

            <label>Mô tả</label>

            <textarea name="description"
                class="form-control"
                rows="5"></textarea>

        </div>

        <button type="submit"
            class="submit-btn">

            Thêm danh mục

        </button>

        <div style="margin-top: 10px;">
            <a href="/NguyenDuongBao_0154/Category/list" class="submit-btn" style="display: inline-block; text-decoration: none; text-align: center;">← Quay lại</a>
        </div>

    </form>

</div>

<?php require './app/views/shares/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('add-category-form');

    if (!form) return;

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);
        const payload = {
            name: formData.get('name') || '',
            description: formData.get('description') || ''
        };

        fetch('/NguyenDuongBao_0154/api/category', {
            method: 'POST',
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
                    alert('Thêm danh mục thất bại.');
                }
            })
            .catch(function () {
                alert('Không thể thêm danh mục lúc này.');
            });
    });
});
</script>