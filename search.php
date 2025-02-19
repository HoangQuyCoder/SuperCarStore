<?php
include_once './php/db_connect.php';

$conn = getDatabaseConnection();

// Initialize variables
$searchQuery = '';
$products = [];

// Check if the form was submitted
if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];

    // Prepare and execute the SQL statement for search
    $sql = "SELECT * FROM products WHERE title LIKE ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("SQL Error: " . $conn->error); // Output the error message
    }

    $searchTerm = "%" . $searchQuery . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch results for search
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
}

// Close the connection
$conn->close();
?>

<?php include_once("navbar.php"); ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        margin-bottom: auto;
    }

    .search {
        padding-top: 8%;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .product-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 2%;
        margin-bottom: 8%;
    }

    .product-item {
        background: #fff;
        border-radius: 10px;
        padding: 15px;
        width: 300px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s ease-in-out;
    }

    .product-item:hover {
        transform: translateY(-5px);
    }

    .product-item h2 {
        font-size: 18px;
        color: #333;
        margin-bottom: 10px;
    }

    .product-item p {
        font-size: 14px;
        color: #666;
        margin: 5px 0;
    }

    .product-item p:last-child {
        font-weight: bold;
        color: #e60000;
    }
</style>

<body>
    <div class="search">
        <h1>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h1>
        <div class="product-list row">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-item">
                        <h2><?php echo htmlspecialchars($product['title']); ?></h2>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <p>Price: <?php echo htmlspecialchars($product['price']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>


<!-- footer  -->
<?php include("footer.php"); ?>