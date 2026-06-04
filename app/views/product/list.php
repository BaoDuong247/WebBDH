<?php require './app/views/shares/header.php'; ?>
<?php $sectionTitle = SessionHelper::isAdmin() ? 'Bộ sưu tập đồng hồ' : 'Sản phẩm'; ?>

<section class="hero">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Đồng hồ <span>cao cấp</span> dành cho giới thượng lưu</h1>
            <p>Bộ sưu tập đồng hồ sang trọng, hiện đại và đẳng cấp.</p>
            <div class="hero-buttons">
                <a href="#products" class="hero-btn primary-btn">Xem sản phẩm</a>
                <a href="#featured" class="hero-btn secondary-btn">Nổi bật</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1547996160-81dfa63595aa?q=80&w=1200&auto=format&fit=crop">
        </div>
    </div>
</section>

<section class="section" id="featured">
    <div class="section-title">Sản phẩm nổi bật</div>
    <div class="featured-grid">
        <div class="featured-card">
            <img src="https://images.unsplash.com/photo-1523170335258-f5ed11844a49?q=80&w=1200&auto=format&fit=crop">
            <div class="featured-info">
                <h2>Rolex Premium</h2>
                <p>Thiết kế sang trọng, đẳng cấp doanh nhân.</p>
                <div class="featured-price">$125.000</div>
            </div>
        </div>
        <div class="featured-card">
            <img src="https://images.unsplash.com/photo-1612817159949-195b6eb9e31a?q=80&w=1200&auto=format&fit=crop">
            <div class="featured-info">
                <h2>Omega Classic</h2>
                <p>Vẻ đẹp hiện đại, mạnh mẽ.</p>
                <div class="featured-price">$98.000</div>
            </div>
        </div>
        <div class="featured-card">
            <img src="https://images.unsplash.com/photo-1434056886845-dac89ffe9b56?q=80&w=1200&auto=format&fit=crop">
            <div class="featured-info">
                <h2>Hublot Gold</h2>
                <p>Phong cách thượng lưu.</p>
                <div class="featured-price">$145.000</div>
            </div>
        </div>
    </div>
</section>

<section class="section" id="products">
    <div class="section-title"><?php echo htmlspecialchars($sectionTitle); ?></div>
    <div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px;">
        <?php foreach ($products as $product): ?>
            <div class="product-card" style="display: flex; flex-direction: column; height: 100%; min-height: 520px; box-sizing: border-box; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                <?php
                $p = is_object($product) ? $product : (object)$product;
                $pArr = is_array($product) ? $product : (array)$product;
                
                $img = $p->image ?? $pArr['image'] ?? null;
                $name = $p->name ?? $pArr['name'] ?? "";
                $desc = $p->description ?? $pArr['description'] ?? "";
                $price = $p->price ?? $pArr['price'] ?? 0;
                $catName = $p->category_name ?? $pArr['category_name'] ?? null;
                $id = $p->id ?? $pArr['id'] ?? null;

                // Xử lý loại bỏ khoảng trắng và chuẩn hóa link ảnh
                $cleanImg = !empty($img) ? trim($img) : ''; 
                if (strpos($cleanImg, 'public/') !== false) {
                    $imgPath = "/NguyenDuongBao_0154/" . $cleanImg;
                } else {
                    $imgPath = "/NguyenDuongBao_0154/public/images/" . $cleanImg;
                }
                ?>
                
                <div style="height: 240px; width: 100%; display: flex; align-items: center; justify-content: center; overflow: hidden; background: #fafafa; border-bottom: 1px solid #eee;">
                    <?php if (!empty($cleanImg)): ?>
                        <img class="product-image" src="<?php echo htmlspecialchars($imgPath); ?>" alt="<?php echo htmlspecialchars($name); ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1547996160-81dfa63595aa?q=80&w=1200&auto=format&fit=crop';">
                    <?php else: ?>
                        <img class="product-image" src="https://images.unsplash.com/photo-1547996160-81dfa63595aa?q=80&w=1200&auto=format&fit=crop" alt="Default image" style="width: 100%; height: 100%; object-fit: cover;">
                    <?php endif; ?>
                </div>
                
                <div class="product-info" style="display: flex; flex-direction: column; flex-grow: 1; padding: 15px; box-sizing: border-box;">
                    <div class="product-title" style="font-size: 18px; font-weight: bold; margin-bottom: 8px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #111;"><?php echo htmlspecialchars($name); ?></div>
                    <div class="product-desc" style="font-size: 14px; color: #666; margin-bottom: 10px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 40px; line-height: 20px;"><?php echo htmlspecialchars($desc); ?></div>
                    <div class="product-price" style="font-size: 16px; font-weight: bold; color: #b8860b; margin-bottom: 5px;"><?php echo '$' . number_format((float)$price, 0, ',', '.'); ?></div>
                    <div class="product-category" style="font-size: 13px; color: #888; margin-bottom: 15px;">Danh mục: <?php echo htmlspecialchars($catName ?? 'Chưa có'); ?></div>
                    
                    <div class="action-group" style="display: flex; flex-direction: column; gap: 8px; margin-top: auto;">
                        <?php 
                        $isInCart = isset($_SESSION['cart'][$id]);
                        if ($isInCart): 
                            $cartItem = $_SESSION['cart'][$id];
                            $subtotal = $cartItem['price'] * $cartItem['quantity'];
                        ?>
                            <div style="width: 100%; border: 1px solid #dfb76c; border-radius: 6px; padding: 6px; background-color: #faf8f5; box-sizing: border-box;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                                    <a class="ajax-qty" data-id="<?php echo $id; ?>" data-action="decrease" href="/NguyenDuongBao_0154/Product/updateCartQuantity/<?php echo $id; ?>/decrease" style="background-color: #333; color: #dfb76c; width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 14px;">-</a>
                                    <span class="cart-qty" data-id="<?php echo $id; ?>" style="font-weight: bold; color: #111; font-size: 13px;">Số lượng: <?php echo $cartItem['quantity']; ?></span>
                                    <a class="ajax-qty" data-id="<?php echo $id; ?>" data-action="increase" href="/NguyenDuongBao_0154/Product/updateCartQuantity/<?php echo $id; ?>/increase" style="background-color: #dfb76c; color: #111; width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 14px;">+</a>
                                </div>
                                <div class="cart-subtotal" data-id="<?php echo $id; ?>" style="text-align: center; font-size: 12px; color: #b8860b; font-weight: bold; border-top: 1px dashed #dfb86c; padding-top: 4px; margin-top: 4px;">Thành tiền: $<?php echo number_format($subtotal, 0, ',', '.'); ?></div>
                            </div>
                        <?php else: ?>
                            <a class="btn-cart scroll-btn" href="/NguyenDuongBao_0154/Product/addToCart/<?php echo $id; ?>" style="background-color: #111; color: #dfb76c; border: 1px solid #dfb76c; padding: 8px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: bold; text-align: center; display: block;">🛒 Thêm vào giỏ hàng</a>
                        <?php endif; ?>
                        
                        <div style="display: flex; gap: 4px; width: 100%;">
                            <a class="btn btn-view" style="flex: 1; text-align: center; padding: 6px 0; font-size: 12px; border-radius: 4px;" href="/NguyenDuongBao_0154/Product/show/<?php echo htmlspecialchars($id); ?>">👁 Xem</a>
                            <?php if (SessionHelper::isAdmin()): ?>
                                <a class="btn btn-edit" style="flex: 1; text-align: center; padding: 6px 0; font-size: 12px; border-radius: 4px;" href="/NguyenDuongBao_0154/Product/edit/<?php echo htmlspecialchars($id); ?>">✏ Sửa</a>
                                <a class="btn btn-delete" style="flex: 1; text-align: center; padding: 6px 0; font-size: 12px; border-radius: 4px;" href="/NguyenDuongBao_0154/Product/delete/<?php echo htmlspecialchars($id); ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')">🗑 Xóa</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (localStorage.getItem("listPageScroll")) {
        window.scrollTo(0, parseInt(localStorage.getItem("listPageScroll")));
        localStorage.removeItem("listPageScroll");
    }
    var scrollButtons = document.querySelectorAll('.scroll-btn');
    scrollButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            localStorage.setItem("listPageScroll", window.scrollY);
        });
    });

    // AJAX quantity update for product list cards
    function formatNumberDot(n) {
        return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    var ajaxQtyButtons = document.querySelectorAll('.ajax-qty');
    ajaxQtyButtons.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var id = this.getAttribute('data-id');
            var action = this.getAttribute('data-action');
            var url = this.getAttribute('href');
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' }, method: 'GET' })
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    if (data && data.success) {
                        // update quantity display
                        var qtySpan = document.querySelector('.cart-qty[data-id="' + id + '"]');
                        if (qtySpan) {
                            qtySpan.textContent = 'Số lượng: ' + (data.quantity);
                        }
                        // update subtotal for this card
                        var sub = document.querySelector('.cart-subtotal[data-id="' + id + '"]');
                        if (sub) {
                            sub.textContent = 'Thành tiền: $' + formatNumberDot(data.itemTotal);
                        }
                    }
                }).catch(function(err){
                    console.error('AJAX qty update failed', err);
                    // fallback: follow link
                    window.location = url;
                });
        });
    });
});
</script>
<?php require './app/views/shares/footer.php'; ?>