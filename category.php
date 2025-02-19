<?php
include_once './php/db_connect.php';
include("./php/db-type-product.php");

$conn = getDatabaseConnection();

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();

?>

<?php include("navbar.php"); ?>

<!-- Content -->
<div class="content-list row" style=" margin-top: 0%; ">
    <div class="content-container row" style=" margin-top: 4%; padding:5%">
        <div class="cartegory-left">
            <ul>
                <li class="cartegory-left-li">
                    <a href="">Sản phẩm</a>
                    <ul>
                        <li><a href="#" onclick="filterByBrand('Electric Vehicles')">Electric Vehicles</a></li>
                        <li><a href="#" onclick="filterByBrand('Luxury Cars')">Luxury Cars</a></li>
                        <li><a href="#" onclick="filterByBrand('Mainstream Cars')">Mainstream Cars</a></li>
                        <li><a href="#" onclick="filterByBrand('American Cars')">American Cars</a></li>
                        <li><a href="#" onclick="filterByBrand('Trucks & SUVs')">Trucks & SUVs</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="cartegory-right">
            <div class="top-item">
                <div class="cartegory-right-top-item">
                    <p id="brand"></p>
                </div>

                <div class="cartegory-right-top-item">
                    <select name="" id="sort-select">
                        <option value="">Sắp xếp</option>
                        <option value="lowToHigh">Giá thấp đến cao</option>
                        <option value="highToLow">Giá cao đến thấp</option>
                    </select>
                </div>
            </div>
            <div class="cartegory-right-content row" id="cartegory-right-content">
                <?php
                if (!empty($products)) {
                    foreach ($products as $product) {

                        $images = $product['images'];
                        $type = strtolower(htmlspecialchars($product['type'], ENT_QUOTES));
                        $title = htmlspecialchars($product['title'], ENT_QUOTES);
                        $price = htmlspecialchars($product['price'], ENT_QUOTES);
                        $id = $product['products_id'];

                        echo "<div class='cartegory-right-content-item' id='$type' >
                                    <a  onclick='openProductDetail($id)'>
                                        <img src='./uploads/$images' alt=''>
                                        <h1>$title</h1>
                                    </a>
                                    <p>$price VND</p>
                                </div>";
                    }
                } else {
                    echo "<p>No products available.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- footer  -->
<?php include("footer.php"); ?>

<script>
    document.getElementById('sort-select').addEventListener('change', function() {
        var sortBy = this.value;
        var productsContainer = document.getElementById('cartegory-right-content');
        var products = Array.from(productsContainer.getElementsByClassName('cartegory-right-content-item'));

        products.sort(function(a, b) {
            var priceA = parseInt(a.querySelector('p').innerText.replace(/[^0-9]/g, ''));
            var priceB = parseInt(b.querySelector('p').innerText.replace(/[^0-9]/g, ''));

            if (sortBy === 'lowToHigh') {
                return priceA - priceB;
            } else if (sortBy === 'highToLow') {
                return priceB - priceA;
            }
        });

        // Xóa các sản phẩm hiện tại và thêm lại theo thứ tự mới
        productsContainer.innerHTML = '';
        products.forEach(function(product) {
            productsContainer.appendChild(product);
        });
    });
</script>

<script src="js/product-cart.js" type="text/javascript"></script>
<script src="js/danhmuc.js" type="text/javascript"></script>

</body>

</html>