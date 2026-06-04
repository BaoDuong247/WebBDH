<?php require './app/views/shares/header.php'; ?>
<section style="padding: 60px 20px; max-width: 1100px; margin: 0 auto; min-height: 600px; box-sizing: border-box; color: #fff;">
    <div style="margin-bottom: 30px;">
        <a href="/NguyenDuongBao_0154/Product/list" style="color: #dfb76c; text-decoration: none; font-size: 15px; display: inline-flex; align-items: center; gap: 5px;">⬅ Trở về trang chủ</a>
    </div>
    
    <div style="display: flex; flex-wrap: wrap; gap: 40px; background: #1a1a1a; padding: 40px; border-radius: 12px; border: 1px solid #2d2d2d; box-shadow: 0 12px 40px rgba(0,0,0,0.5);">
        <div style="flex: 1 1 450px; height: 400px; background: #252525; border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 1px solid #333;">
            <?php 
            $cleanProductImg = !empty($product->image) ? trim($product->image) : ''; 
            if (strpos($cleanProductImg, 'public/') !== false) {
                $showImgPath = "/NguyenDuongBao_0154/" . $cleanProductImg;
            } else {
                $showImgPath = "/NguyenDuongBao_0154/public/images/" . $cleanProductImg;
            }
            if (!empty($cleanProductImg)): 
            ?>
                <img src="<?php echo htmlspecialchars($showImgPath); ?>" alt="<?php echo htmlspecialchars($product->name); ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1547996160-81dfa63595aa?q=80&w=1200&auto=format&fit=crop';">
            <?php else: ?>
                <img src="https://images.unsplash.com/photo-1547996160-81dfa63595aa?q=80&w=1200&auto=format&fit=crop" alt="Default image" style="width: 100%; height: 100%; object-fit: cover;">
            <?php endif; ?>
        </div>
        
        <div style="flex: 1 1 400px; display: flex; flex-direction: column; justify-content: center;">
            <span style="color: #dfb76c; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; font-weight: bold; margin-bottom: 10px;">Luxury Edition</span>
            <h1 style="font-size: 42px; font-weight: bold; color: #fff; margin: 0 0 15px 0; border-bottom: 2px solid #dfb76c; padding-bottom: 15px;"><?php echo htmlspecialchars($product->name); ?></h1>
            <div style="font-size: 28px; font-weight: bold; color: #dfb76c; margin-bottom: 20px;">$<?php echo number_format((float)$product->price, 0, ',', '.'); ?></div>
            <p style="font-size: 16px; color: #ccc; line-height: 1.8; margin: 0 0 30px 0; min-height: 80px;"><?php echo htmlspecialchars($product->description); ?></p>
            
            <div style="display: flex; gap: 15px; align-items: stretch;">
                <?php 
                $productId = $product->id;
                $isInCart = isset($_SESSION['cart'][$productId]);
                if ($isInCart): 
                    $cartItem = $_SESSION['cart'][$productId];
                ?>
                    <div style="flex: 1; border: 1px solid #dfb76c; border-radius: 6px; padding: 10px 15px; background: #252525; box-sizing: border-box; display: flex; flex-direction: column; justify-content: center; min-height: 55px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a href="/NguyenDuongBao_0154/Product/updateCartQuantity/<?php echo $productId; ?>/decrease" style="background: #333; color: #dfb76c; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 16px;">-</a>
                            <span style="font-weight: bold; color: #fff; font-size: 14px;">Số lượng trong giỏ: <?php echo $cartItem['quantity']; ?></span>
                            <a href="/NguyenDuongBao_0154/Product/updateCartQuantity/<?php echo $productId; ?>/increase" style="background: #dfb76c; color: #111; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 16px;">+</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="/NguyenDuongBao_0154/Product/addToCart/<?php echo $product->id; ?>" style="flex: 1; background: #dfb76c; color: #111; padding: 0 20px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-flex; align-items: center; justify-content: center; text-align: center; border: 1px solid #dfb76c; min-height: 55px; box-sizing: border-box;">🛒 Mua Ngay (Thêm vào giỏ)</a>
                <?php endif; ?>
                <?php if (SessionHelper::isAdmin()): ?>
                    <a href="/NguyenDuongBao_0154/Product/edit/<?php echo $product->id; ?>" style="flex: 1; background: transparent; color: #ccc; padding: 0 20px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-flex; align-items: center; justify-content: center; text-align: center; border: 1px solid #444; min-height: 55px; box-sizing: border-box;">✏ Chỉnh sửa thông tin</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php require './app/views/shares/footer.php'; ?>