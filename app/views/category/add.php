<?php require './app/views/shares/header.php'; ?>

<div class="form-wrapper">

    <div class="form-title">

        Thêm danh mục

    </div>

    <form method="POST"
        action="/NguyenDuongBao_0154/Category/save">

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