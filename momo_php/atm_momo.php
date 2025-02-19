<?php
include_once '../php/db_connect.php';

$conn = getDatabaseConnection();
session_start();

if (isset($_SESSION['guest_customer_id'])) {
    $customer_id = (int)$_SESSION['guest_customer_id'];
} else {
    die("Guest session not found. Please try again.");
}

$sql = "SELECT customer_name, _address, district, province, phone 
FROM customer 
WHERE customer_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_id); // "i" means integer
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $customername = $row['customer_name'];
    $phone = $row['phone'];
    $address = $row['_address'] . ", " . $row['district'] . ", " . $row['province'];
}

$stmt->close();

$cart_items = $conn->query("SELECT c.product_id, c.quantity, p.title, p.price, p.discount FROM cart c JOIN products p ON c.product_id = p.products_id");
// Initialize total price
$total_price = 0;
$orderId = time() . "";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MoMo Sandbox</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet"
        href="./statics/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <!-- CSS -->
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Initial payment/Khởi tạo thanh toán ATM qua MoMo</h3>
                    </div>
                    <div class="panel-body">
                        <form class="" enctype="application/x-www-form-urlencoded"
                            action="momo_pay.php">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fxRate" class="col-form-label">Order ID: </label>
                                        <div class='input-group date' id='fxRate'>
                                            <?php echo $orderId; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fxRate" class="col-form-label">Customer Name: </label>
                                        <div class='input-group date' id='fxRate'>
                                            <?php echo $customername; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fxRate" class="col-form-label">Phone Numer: </label>
                                        <div class='input-group date' id='fxRate'>
                                            <?php echo $phone; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fxRate" class="col-form-label"> Product: </label>
                                        <div class='input-group date' id='fxRate'>

                                            <?php while ($item = $cart_items->fetch_assoc()): ?>
                                                <?php
                                                $discounted_price = $item['discount'] == 1 ? $item['price'] * 0.9 : $item['price'];

                                                $item_total = $discounted_price * $item['quantity'];

                                                $total_price += $item_total;
                                                ?>
                                                <p><?= htmlspecialchars($item['title']) ?>: <?= $item['quantity'] ?></p>
                                            <?php endwhile; ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fxRate" class="col-form-label">Amount: </label>
                                        <div class='input-group date' id='fxRate'>
                                            <?php echo $total_price ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fxRate" class="col-form-label">OrderInfo</label>
                                        <div class='input-group date' id='fxRate'>
                                            <p> Thanh toan qua MoMo</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fxRate" class="col-form-label">Address:</label>
                                        <div class='input-group date' id='fxRate'>
                                            <?php echo $address; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <p>
                            <div style="margin-top: 1em;">
                                <button class="btn btn-primary btn-block">Start MoMo payment....</button>
                            </div>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="./statics/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="./statics/moment/min/moment.min.js"></script>

</html>