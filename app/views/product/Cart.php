<?php require './app/views/shares/header.php'; ?>

<section id="cart" style="padding: 60px 20px; max-width: 1000px; margin: 0 auto; min-height: 600px; box-sizing: border-box; color: #fff;">
    
    <h1 style="font-size: 28px; font-weight: bold; color: #dfb76c; border-bottom: 1px solid #333; padding-bottom: 15px; margin-bottom: 30px;">
        🛒 Giỏ Hàng Của Bạn
    </h1>

    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <div style="background: #1a1a1a; border-radius: 8px; border: 1px solid #2d2d2d; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.4);">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #252525; color: #dfb76c; border-bottom: 1px solid #333; font-size: 14px;">
                        <th style="padding: 15px;">Hình ảnh</th>
                        <th style="padding: 15px;">Sản phẩm</th>
                        <th style="padding: 15px;">Giá bán</th>
                        <th style="padding: 15px; text-align: center;">Số lượng</th>
                        <th style="padding: 15px; text-align: right;">Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $grandTotal = 0;
                    foreach ($_SESSION['cart'] as $id => $item): 
                        $totalPrice = $item['price'] * $item['quantity'];
                        $grandTotal += $totalPrice;
                    ?>
                        <tr style="border-bottom: 1px solid #2d2d2d; font-size: 15px;">
                            <!-- Sửa lỗi hiển thị đường dẫn ảnh -->
                            <td style="padding: 15px; width: 90px;">
                                <div style="width: 70px; height: 70px; background: #fff; border-radius: 4px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                    <?php if (!empty($item['image'])): ?>
                                        <img src="/NguyenDuongBao_0154/<?php echo htmlspecialchars($item['image']); ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    <?php else: ?>
                                        <img src="https://images.unsplash.com/photo-1547996160-81dfa63595aa?q=80&w=1200&auto=format&fit=crop" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td style="padding: 15px; font-weight: bold; color: #fff;">
                                <?php echo htmlspecialchars($item['name']); ?>
                            </td>
                            <td style="padding: 15px; color: #ccc;">
                                $<?php echo number_format($item['price'], 0, ',', '.'); ?>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <div style="display: inline-flex; align-items: center; gap: 10px; background: #2a2a2a; padding: 4px 10px; border-radius: 4px;">
                                    <a class="scroll-btn" href="/NguyenDuongBao_0154/Product/updateCartQuantity/<?php echo $id; ?>/decrease" style="color: #dfb76c; text-decoration: none; font-weight: bold;">-</a>
                                    <span style="font-weight: bold; min-width: 20px; display: inline-block;"><?php echo $item['quantity']; ?></span>
                                    <a class="scroll-btn" href="/NguyenDuongBao_0154/Product/updateCartQuantity/<?php echo $id; ?>/increase" style="color: #dfb76c; text-decoration: none; font-weight: bold;">+</a>
                                </div>
                            </td>
                            <td style="padding: 15px; text-align: right; color: #dfb76c; font-weight: bold;">
                                $<?php echo number_format($totalPrice, 0, ',', '.'); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Tổng đơn hàng & Nút hành động -->
            <div style="padding: 25px; display: flex; justify-content: space-between; align-items: center; background: #222; border-top: 1px solid #333; flex-wrap: wrap; gap: 15px;">
                <div style="font-size: 18px;">
                    Tổng thanh toán: <span style="color: #dfb76c; font-size: 24px; font-weight: bold; margin-left: 10px;">$<?php echo number_format($grandTotal, 0, ',', '.'); ?></span>
                </div>
                <div style="display: flex; gap: 12px;">
                    <a href="/NguyenDuongBao_0154/Product/list" style="border: 1px solid #dfb76c; color: #dfb76c; padding: 10px 20px; border-radius: 4px; text-decoration: none; font-size: 14px; font-weight: bold;">
                        🔄 Tiếp tục mua sắm
                    </a>
                    <a href="/NguyenDuongBao_0154/Product/checkout" style="background: #dfb76c; color: #111; padding: 10px 25px; border-radius: 4px; text-decoration: none; font-size: 14px; font-weight: bold; display: inline-block; transition: 0.3s;">
    💳 Tiến hành thanh toán
</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Trạng thái giỏ trống -->
        <div style="text-align: center; padding: 50px 20px; background: #1a1a1a; border-radius: 8px; border: 1px solid #2d2d2d;">
            <p style="font-size: 18px; color: #aaa; margin-bottom: 20px;">Giỏ hàng của bạn đang trống.</p>
            <a href="/NguyenDuongBao_0154/Product/list" style="background: #dfb76c; color: #111; padding: 10px 25px; border-radius: 4px; text-decoration: none; font-weight: bold; display: inline-block;">
                Quay lại cửa hàng
            </a>
        </div>
    <?php endif; ?>

</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('cartPageScroll')) {
        window.scrollTo(0, parseInt(localStorage.getItem('cartPageScroll'), 10));
        localStorage.removeItem('cartPageScroll');
    }
    var scrollButtons = document.querySelectorAll('.scroll-btn');
    scrollButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            localStorage.setItem('cartPageScroll', window.scrollY);
        });
    });
});
</script>

<?php require './app/views/shares/footer.php'; ?>