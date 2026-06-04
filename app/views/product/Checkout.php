<?php include 'app/views/shares/header.php'; ?>

<section style="padding: 60px 20px; max-width: 1100px; margin: 0 auto; min-height: 600px; box-sizing: border-box; color: #fff;">
    
    <div style="margin-bottom: 20px;">
        <a href="/NguyenDuongBao_0154/Product/cart" style="color: #dfb76c; text-decoration: none; font-size: 15px; display: inline-flex; align-items: center; gap: 5px;">
            ⬅ Quay lại giỏ hàng
        </a>
    </div>

    <h1 style="font-size: 28px; font-weight: bold; color: #dfb76c; border-bottom: 1px solid #333; padding-bottom: 15px; margin-bottom: 30px; text-transform: uppercase; letter-spacing: 1px;">
        📇 Thông Tin Thanh Toán
    </h1>

    <div style="display: flex; flex-wrap: wrap; gap: 40px;">
        
        <div style="flex: 1 1 500px; background: #1a1a1a; padding: 30px; border-radius: 8px; border: 1px solid #2d2d2d; box-shadow: 0 8px 25px rgba(0,0,0,0.3);">
            <h3 style="color: #dfb76c; margin-top: 0; margin-bottom: 25px; font-size: 18px; border-bottom: 1px dashed #333; padding-bottom: 10px;">
                Địa Chỉ Giao Hàng
            </h3>
            
            <form method="POST" action="/NguyenDuongBao_0154/Product/processCheckout" style="display: flex; flex-direction: column; gap: 20px;">
                
                <div class="form-group">
                    <label for="name" style="display: block; font-size: 14px; color: #ccc; margin-bottom: 8px; font-weight: 500;">Họ tên *</label>
                    <input type="text" id="name" name="name" class="form-control" required 
                           style="width: 100%; padding: 12px; background: #252525; border: 1px solid #444; border-radius: 4px; color: #fff; box-sizing: border-box; font-size: 15px; transition: 0.3s;">
                </div>

                <div class="form-group">
                    <label for="phone" style="display: block; font-size: 14px; color: #ccc; margin-bottom: 8px; font-weight: 500;">Số điện thoại *</label>
                    <input type="text" id="phone" name="phone" class="form-control" required 
                           style="width: 100%; padding: 12px; background: #252525; border: 1px solid #444; border-radius: 4px; color: #fff; box-sizing: border-box; font-size: 15px;">
                </div>

                <div class="form-group">
                    <label for="address" style="display: block; font-size: 14px; color: #ccc; margin-bottom: 8px; font-weight: 500;">Địa chỉ nhận hàng *</label>
                    <textarea id="address" name="address" class="form-control" required rows="4" 
                              style="width: 100%; padding: 12px; background: #252525; border: 1px solid #444; border-radius: 4px; color: #fff; box-sizing: border-box; font-size: 15px; resize: none; line-height: 1.5;"></textarea>
                </div>

                <button type="submit" class="btn btn-primary" 
                        style="background: #dfb76c; color: #111; border: 1px solid #dfb76c; padding: 14px; border-radius: 4px; font-weight: bold; font-size: 16px; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s; margin-top: 10px;">
                    💳 Xác Nhận Thanh Toán
                </button>
                
            </form>
        </div>

        <div style="flex: 1 1 350px; background: #222; padding: 30px; border-radius: 8px; border: 1px solid #333; height: fit-content; box-shadow: 0 8px 25px rgba(0,0,0,0.2);">
            <h3 style="color: #dfb76c; margin-top: 0; margin-bottom: 20px; font-size: 18px; border-bottom: 1px dashed #444; padding-bottom: 10px;">
                Đơn Hàng Của Bạn
            </h3>
            
            <div style="max-height: 240px; overflow-y: auto; margin-bottom: 20px; padding-right: 5px;">
                <?php 
                $grandTotal = 0;
                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0):
                    foreach ($_SESSION['cart'] as $item): 
                        $totalPrice = $item['price'] * $item['quantity'];
                        $grandTotal += $totalPrice;
                ?>
                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 14px; padding: 10px 0; border-bottom: 1px solid #2d2d2d; gap: 10px;">
                            <span style="color: #ccc; max-width: 70%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <?php echo htmlspecialchars($item['name']); ?> 
                                <b style="color: #dfb76c; margin-left: 4px;">x<?php echo $item['quantity']; ?></b>
                            </span>
                            <span style="color: #fff; font-weight: bold; white-space: nowrap;">
                                $<?php echo number_format($totalPrice, 0, ',', '.'); ?>
                            </span>
                        </div>
                <?php 
                    endforeach;
                endif; 
                ?>
            </div>

            <div style="border-top: 2px solid #dfb76c; padding-top: 20px; display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 16px; font-weight: bold; uppercase;">Tổng thanh toán:</span>
                <span style="color: #dfb76c; font-size: 22px; font-weight: bold;">
                    $<?php echo number_format($grandTotal, 0, ',', '.'); ?>
                </span>
            </div>
        </div>

    </div>

</section>

<?php include 'app/views/shares/footer.php'; ?>