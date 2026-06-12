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
    <div id="product-grid" class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px;"></div>
</section>

<script>
function formatNumberDot(n) {
    return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function renderProductCard(product) {
    const basePath = '/NguyenDuongBao_0154';
    const id = product.id;
    const image = product.image ? product.image.trim() : '';
    const imageUrl = image && image.indexOf('public/') !== -1
        ? basePath + '/' + image
        : basePath + '/public/images/' + image;
    const fallbackUrl = 'https://images.unsplash.com/photo-1547996160-81dfa63595aa?q=80&w=1200&auto=format&fit=crop';
    const price = Number(product.price || 0);
    const categoryName = product.category_name || 'Chưa có';

    return `
        <article class="product-card" style="display: flex; flex-direction: column; height: 100%; min-height: 520px; box-sizing: border-box; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <div style="height: 240px; width: 100%; display: flex; align-items: center; justify-content: center; overflow: hidden; background: #fafafa; border-bottom: 1px solid #eee;">
                <img class="product-image" src="${image ? imageUrl : fallbackUrl}" alt="${product.name || 'Sản phẩm'}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='${fallbackUrl}';">
            </div>
            <div class="product-info" style="display: flex; flex-direction: column; flex-grow: 1; padding: 15px; box-sizing: border-box;">
                <div class="product-title" style="font-size: 18px; font-weight: bold; margin-bottom: 8px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #111;">${product.name || 'Sản phẩm'}</div>
                <div class="product-desc" style="font-size: 14px; color: #666; margin-bottom: 10px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 40px; line-height: 20px;">${product.description || ''}</div>
                <div class="product-price" style="font-size: 16px; font-weight: bold; color: #b8860b; margin-bottom: 5px;">$${formatNumberDot(price.toFixed(0))}</div>
                <div class="product-category" style="font-size: 13px; color: #888; margin-bottom: 15px;">Danh mục: ${categoryName}</div>
                <div class="action-group" style="display: flex; flex-direction: column; gap: 8px; margin-top: auto;">
                    <a class="btn-cart" href="${basePath}/Product/addToCart/${id}" style="background-color: #111; color: #dfb76c; border: 1px solid #dfb76c; padding: 8px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: bold; text-align: center; display: block;">🛒 Thêm vào giỏ hàng</a>
                    <div style="display: flex; gap: 4px; width: 100%;">
                        <a class="btn btn-view" style="flex: 1; text-align: center; padding: 6px 0; font-size: 12px; border-radius: 4px;" href="${basePath}/Product/show/${id}">👁 Xem</a>
                        ${isAdmin ? `<a class="btn btn-edit" style="flex: 1; text-align: center; padding: 6px 0; font-size: 12px; border-radius: 4px;" href="${basePath}/Product/edit/${id}">✏ Sửa</a>` : ''}
                        ${isAdmin ? `<button class="btn btn-delete" type="button" style="flex: 1; text-align: center; padding: 6px 0; font-size: 12px; border-radius: 4px; cursor: pointer;" onclick="deleteProduct(${id})">🗑 Xóa</button>` : ''}
                    </div>
                </div>
            </div>
        </article>
    `;
}

function deleteProduct(id) {
    if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) return;

    fetch('/NguyenDuongBao_0154/api/product/' + id, {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' }
    })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            if (data && data.message && data.message.toLowerCase().indexOf('success') !== -1) {
                location.reload();
            } else {
                alert('Xóa sản phẩm thất bại.');
            }
        })
        .catch(function() {
            alert('Không thể xóa sản phẩm lúc này.');
        });
}

const isAdmin = <?php echo SessionHelper::isAdmin() ? 'true' : 'false'; ?>;

document.addEventListener("DOMContentLoaded", function() {
    const productGrid = document.getElementById('product-grid');

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

    if (productGrid) {
        fetch('/NguyenDuongBao_0154/api/product')
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Request failed');
                }
                return response.json();
            })
            .then(function(data) {
                if (!Array.isArray(data)) {
                    productGrid.innerHTML = '<p style="color: #fff;">Không có sản phẩm nào.</p>';
                    return;
                }

                productGrid.innerHTML = '';
                data.forEach(function(product) {
                    const card = document.createElement('div');
                    card.innerHTML = renderProductCard(product);
                    productGrid.appendChild(card.firstElementChild);
                });
            })
            .catch(function() {
                productGrid.innerHTML = '<p style="color: #fff;">Không thể tải danh sách sản phẩm.</p>';
            });
    }
});
</script>
<?php require './app/views/shares/footer.php'; ?>











