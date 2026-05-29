<?php require './app/views/shares/header.php'; ?>

<div class="form-wrapper">

    <div class="form-title">

        Chỉnh sửa sản phẩm

    </div>

    <form method="POST"
        enctype="multipart/form-data"
        action="/NguyenDuongBao_0154/Product/update">

        <input type="hidden"
            name="id"
            value="<?php echo $product->id; ?>">

        <input type="hidden"
            name="old_image"
            value="<?php echo $product->image; ?>">

        <div class="form-group">

            <label>Tên sản phẩm</label>

            <input type="text"
                name="name"
                class="form-control"
                value="<?php echo $product->name; ?>"
                required>

        </div>

        <div class="form-group">

            <label>Mô tả</label>

            <textarea name="description"
                class="form-control"
                rows="5"><?php echo $product->description; ?></textarea>

        </div>

        <div class="form-group">

            <label>Giá</label>

            <input type="number"
                name="price"
                class="form-control"
                value="<?php echo $product->price; ?>"
                required>

        </div>

        <div class="form-group">

            <label>Danh mục</label>

            <select name="category_id"
                class="form-control">

                <?php foreach ($categories as $category): ?>

                    <option
                        value="<?php echo $category->id; ?>"

                        <?php
                        if ($product->category_id == $category->id)
                            echo "selected";
                        ?>>

                        <?php echo $category->name; ?>

                    </option>

                <?php endforeach; ?>

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