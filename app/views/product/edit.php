<?php require './app/views/shares/header.php'; ?>
<?php
$currentProduct = isset($product) && is_object($product)
    ? $product
    : (object) ['id' => 0, 'name' => '', 'description' => '', 'price' => 0, 'category_id' => null, 'image' => ''];
$categoryList = isset($categories) && is_array($categories) ? $categories : [];
?>

<div class="form-wrapper">

    <div class="form-title">

        Chỉnh sửa sản phẩm

    </div>

    <form id="edit-product-form"
        method="POST"
        enctype="multipart/form-data">

        <input type="hidden"
            name="id"
            value="<?php echo (int) $currentProduct->id; ?>">

        <input type="hidden"
            name="existing_image"
            value="<?php echo htmlspecialchars($currentProduct->image ?? ''); ?>">

        <div class="form-group">

            <label>Tên sản phẩm</label>

            <input type="text"
                name="name"
                class="form-control"
                value="<?php echo htmlspecialchars($currentProduct->name ?? ''); ?>"
                required>

        </div>

        <div class="form-group">

            <label>Mô tả</label>

            <textarea name="description"
                class="form-control"
                rows="5"><?php echo htmlspecialchars($currentProduct->description ?? ''); ?></textarea>

        </div>

        <div class="form-group">

            <label>Giá</label>

            <input type="number"
                name="price"
                class="form-control"
                value="<?php echo htmlspecialchars($currentProduct->price ?? 0); ?>"
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

            <label>Ảnh mới</label>

            <input type="file"
                name="image"
                class="form-control">

        </div>

        <button type="submit"
            class="submit-btn">

            Cập nhật sản phẩm

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
    const form = document.getElementById('edit-product-form');
    const categorySelect = document.getElementById('category_id');
    const productId = document.querySelector('input[name="id"]').value;

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

            const currentCategory = '<?php echo (int)($currentProduct->category_id ?? 0); ?>';
            if (currentCategory) {
                categorySelect.value = currentCategory;
            }
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
                category_id: formData.get('category_id') || null,
                image: formData.get('existing_image') || null
            };

            fetch('/NguyenDuongBao_0154/api/product/' + productId, {
                method: 'PUT',
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
                        alert('Cập nhật sản phẩm thất bại.');
                    }
                })
                .catch(function () {
                    alert('Không thể cập nhật sản phẩm lúc này.');
                });
        });
    }
});
</script>