<?php
include_once './php/db_connect.php';

$conn = getDatabaseConnection();

session_start();

// Check if order_id is set in the URL
if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    die("Invalid order ID.");
}

$order_id = intval($_GET['order_id']);

// Retrieve order details
$sqlOrder = "SELECT o.order_id, o.order_date, o.status, o.total_price, c.customer_name, c.phone, c._address, c.province, c.district
              FROM orders o
              JOIN customer c ON o.customer_id = c.customer_id
              WHERE o.order_id = ?";
$stmtOrder = $conn->prepare($sqlOrder);
$stmtOrder->bind_param("i", $order_id);
$stmtOrder->execute();
$resultOrder = $stmtOrder->get_result();

if ($resultOrder->num_rows === 0) {
    die("Order not found.");
}

$order = $resultOrder->fetch_assoc();

// Retrieve order items
$sqlOrderItems = "SELECT p.title, oi.quantity, p.price
                  FROM order_detail oi
                  JOIN products p ON oi.product_id = p.products_id
                  WHERE oi.order_id = ?";
$stmtOrderItems = $conn->prepare($sqlOrderItems);
$stmtOrderItems->bind_param("i", $order_id);
$stmtOrderItems->execute();
$resultOrderItems = $stmtOrderItems->get_result();
?>


<?php
include_once("./navbar.php");
?>

<style>
    .container-payment-success {
        width: 80%;
        /* Adjust as needed */
        margin-left: 3%;
        padding: 7%;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-family: sans-serif;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* Add a subtle shadow */
        background-color: #f9f9f9;
        /* Light background color */
    }

    .container-payment-success h1,
    .container-payment-success h2 {
        color: #333;
        /* Darker heading color */
        margin-bottom: 10px;
    }

    .container-payment-success p {
        margin-bottom: 5px;
        line-height: 1.6;
        /* Improve readability */
    }

    .container-payment-success strong {
        font-weight: bold;
    }

    .container-payment-success table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .container-payment-success th,
    .container-payment-success td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
        /* Align text to the left */
    }

    .container-payment-success th {
        background-color: #eee;
        /* Light gray background for header */
        font-weight: bold;
    }

    .container-payment-success tr:nth-child(even) {
        background-color: #f2f2f2;
        /* Subtle alternating row background */
    }

    .container-payment-success a {
        display: inline-block;
        /* Make the link behave like a block element */
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        /* Blue button color */
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        /* Smooth transition on hover */
    }

    .container-payment-success a:hover {
        background-color: #0056b3;
        /* Darker blue on hover */
    }

    .container-payment-success .error-message {
        color: red;
        margin-top: 10px;
    }

    /* Responsive adjustments (example) */
    @media (max-width: 768px) {
        .container-payment-success {
            width: 95%;
            padding: 15px;
        }

        .container-payment-success table {
            font-size: 0.9em;
            /* Smaller font on smaller screens */
        }

        .container-payment-success th,
        .container-payment-success td {
            padding: 8px;
            /* Smaller padding */
        }
    }
</style>

<div class="container-payment-success">
    <h1>Order Confirmation</h1>
    <p>Thank you for your order! Your order has been successfully placed.</p>

    <h2>Order Details</h2>
    <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['order_id']); ?></p>
    <p><strong>Order Date:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
    <p><strong>Status:</strong> <?php
                                if ($order['status'] === 1) {
                                    echo "Đã thanh toán";
                                } else {
                                    echo "Chưa thanh toán";
                                }
                                ?></p>
    <p><strong>Total Price:</strong> $<?php echo number_format($order['total_price'], 2); ?></p>

    <h2>Customer Information</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($order['customer_name']); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($order['phone']); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($order['_address']) . ', ' . htmlspecialchars($order['district']) . ', ' . htmlspecialchars($order['province']); ?></p>

    <h2>Order Items</h2>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = $resultOrderItems->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <p><strong style="color: red;">Please sign up to check bill order!!!!</p></strong>
    <a href="home.php">Back to Home</a>
</div>


<?php
// Close connections
$stmtOrder->close();
$stmtOrderItems->close();
?>


<?php
include_once("./footer.php");
?>