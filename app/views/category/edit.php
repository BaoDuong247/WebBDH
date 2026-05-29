<?php require './app/views/shares/header.php'; ?>

<div class="form-wrapper">

    <div class="form-title">

        Chỉnh sửa danh mục

    </div>

    <form method="POST"
        action="/NguyenDuongBao_0154/Category/update">

        <input type="hidden"
            name="id"
            value="<?php echo $category->id; ?>">

        <div class="form-group">

            <label>Tên danh mục</label>

            <input type="text"
                name="name"
                class="form-control"
                value="<?php echo $category->name; ?>"
                required>

        </div>

        <div class="form-group">

            <label>Mô tả</label>

            <textarea name="description"
                class="form-control"
                rows="5"><?php echo $category->description; ?></textarea>

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