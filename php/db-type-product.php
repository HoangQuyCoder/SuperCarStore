<?php
include_once 'db_connect.php';

$conn = getDatabaseConnection();

// Query to get Canon, Sony, and Nikon products
$sql = "SELECT * FROM products WHERE category_id = 2";
$result = $conn->query($sql);

// Initialize arrays for each brand
$evProducts = [];
$luxuryProducts = [];
$mainstreamProducts = [];
$americanProducts = [];
$truckProducts = [];

if ($result->num_rows > 0) {
    // Fetch all Canon, Sony, and Nikon products
    while ($row = $result->fetch_assoc()) {
        switch ($row['type']) {
            case 'Electric Vehicles':
                $evProducts[] = $row;
                break;
            case 'Luxury Cars':
                $luxuryProducts[] = $row;
                break;
            case 'Mainstream Cars':
                $mainstreamProducts[] = $row;
                break;
            case 'American Cars':
                $americanProducts[] = $row;
                break;
            case 'Trucks & SUVs':
                $truckProducts[] = $row;
                break;
        }
    }
} else {
    echo "No Canon, Sony, or Nikon products found.";
}

$conn->close();
