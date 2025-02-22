<?php
include("sideBar.php");
include("class/checkBillclass.php");
?>

<?php
$bill = new checkBill;
$show_bill = $bill->show_bill();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $insert_bill = $bill->insert_bill($_POST);
    if (isset($insert_bill['errors'])) {
        echo '<script>alert("' . $insert_bill['errors'] . '")</script>';
    } elseif (isset($insert_bill['success'])) {
        echo '<script>alert("' . $insert_bill['success'] . '")</script>';
    }
}
?>

<div class="btn-group">
    <div class="AdminAddBtn">
        <button class="AddProductBtn" onclick="displayAddBox()">Thêm đơn đặt hàng mới</button>
        <div id="addProductModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="closeAddBox()">&times;</span>
                <h2>Thêm đơn đặt hàng mới</h2>
                <form id="addOderForm" action="" method="post">
                    <label for="customerName">Tên khách hàng:</label>
                    <input type="text" name="customerName" id="customerName" required>

                    <label for="productList">Danh sách sản phẩm:</label>
                    <select id="productList" name="productList" required>
                        <option value="">Chọn sản phẩm</option>
                        <?php
                        $resultA = $bill->show_products();
                        if ($resultA) {
                            while ($row = $resultA->fetch_assoc()) {
                                echo '<option value="' . htmlspecialchars($row['products_id']) . '">' . htmlspecialchars($row['title']) . '</option>';
                            }
                        } else {
                            echo '<option value="">Không có sản phẩm nào</option>';
                        }
                        ?>
                    </select>

                    <label for="quantity">Số lượng sản phẩm:</label>
                    <input type="number" name="quantity" id="quantity" required>

                    <label for="address">Địa chỉ giao hàng:</label>
                    <input type="text" name="address" id="address" required>

                    <label for="phone">Số điện thoại:</label>
                    <input type="text" name="phone" id="phone" required>

                    <label for="orderState">Trạng thái đơn hàng:</label>
                    <select id="orderState" name="orderState" required>
                        <option value="0">Chưa thanh toán</option>
                        <option value="1">Đã thanh toán</option>
                    </select>

                    <label for="orderDate">Ngày đặt hàng:</label>
                    <input type="datetime-local" name="orderDate" id="orderDate" required>
                    <br>
                    <button type="submit" id="submit">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="admin-product" id="admin-product">
    <div class="conatiner-sell">
        <h2>Thông tin đơn đặt hàng</h2>
        <table>
            <tr>
                <th>STT</th>
                <th>Tên người đặt</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Trạng thái</th>
                <th>Ngày đặt hàng</th>
                <th>Thao tác</th>
            </tr>
            <?php
            if ($show_bill) {
                $i = 0;
                while ($bills = $show_bill->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td> <?php echo $i ?></td>
                        <td> <?php echo $bills['customer_name'] ?></td>
                        <td> <?php echo $bills['title'] ?></td>
                        <td> <?php echo $bills['quantity'] ?></td>
                        <td> <?php echo number_format($bills['quantity'] * $bills['price']) ?></td>
                        <td> <?php echo $bills['phone'] ?></td>
                        <td> <?php echo $bills['_address'] . ', ' . $bills['district'] . ', ' . $bills['province'] ?></td>
                        <td>
                            <?php
                            echo $bills['status'] == 0 ? 'Chưa thanh toán' : 'Đã thanh toán';
                            ?>
                        </td>
                        <td> <?php echo $bills['order_date'] ?></td>
                        <td>
                            <a href="checkBillEdit.php?order_id=<?php echo $bills['order_id'] ?>"><button>Edit</button></a>
                            <a href="checkBillDelete.php?order_id=<?php echo $bills['order_id'] ?>"><button>Delete</button></a>
                        </td>
                    </tr>
            <?php
                }
            } ?>
        </table>
    </div>
</div>

<script src="js/admin-product.js"></script>

<script>
    const today = new Date();
    const vietnamOffset = 7 * 60;
    const vietnamTime = new Date(today.getTime() + vietnamOffset * 60 * 1000);
    const formattedDate = vietnamTime.toISOString().slice(0, 16);

    document.getElementById('orderDate').value = formattedDate;
</script>

</body>

</html>