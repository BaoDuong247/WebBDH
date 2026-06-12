<?php require './app/views/shares/header.php'; ?>

<div class="form-wrapper">

    <div class="form-title">

        Thêm sản phẩm

    </div>

    <form id="add-product-form"
        method="POST"
        enctype="multipart/form-data">

        <div class="form-group">

            <label>Tên sản phẩm</label>

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

        <div class="form-group">

            <label>Giá sản phẩm</label>

            <input type="number"
                name="price"
                class="form-control"
                required>

        </div>

        <div class="form-group">

            <label>Danh mục</label>

            <select id="category_id"
                name="category_id"
                class="form-control">
                <option value="">-- Chọn danh mục --</option>
            </select>

        </div>

        <div class="form-group">

            <label>Hình ảnh</label>

            <input type="file"
                name="image"
                class="form-control">

        </div>

        <button type="submit"
            class="submit-btn">

            Thêm sản phẩm

        </button>

        <div style="margin-top: 10px; margin-bottom: 15px;">

            <a href="/NguyenDuongBao_0154/Product/list" class="submit-btn" style="display: inline-block; text-decoration: none; text-align: center;">

                ← Quay về trang chủ

            </a>

        </div>

    </form>

</div>

<?php require './app/views/shares/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('category_id');
    const form = document.getElementById('add-product-form');

    fetch('/NguyenDuongBao_0154/api/category')
        .then(function (response) {
            if (!response.ok) throw new Error('Load category failed');
            return response.json();
        })
        .then(function (data) {
            if (!Array.isArray(data)) return;
            categorySelect.innerHTML = '<option value="">-- Chọn danh mục --</option>';
            data.forEach(function (category) {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.name;
                categorySelect.appendChild(option);
            });
        })
        .catch(function () {
            categorySelect.innerHTML = '<option value="">Không tải được danh mục</option>';
        });

    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(form);
            const payload = {
                name: formData.get('name') || '',
                description: formData.get('description') || '',
                price: formData.get('price') || 0,
                category_id: formData.get('category_id') || null
            };

            fetch('/NguyenDuongBao_0154/api/product', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    if (data && data.message && data.message.toLowerCase().indexOf('success') !== -1) {
                        window.location.href = '/NguyenDuongBao_0154/Product/list';
                    } else {
                        alert('Thêm sản phẩm thất bại.');
                    }
                })
                .catch(function () {
                    alert('Không thể thêm sản phẩm lúc này.');
                });
        });
    }
});
</script>