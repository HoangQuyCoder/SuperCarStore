<?php
include_once './php/db_connect.php';

$conn = getDatabaseConnection();

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = mysqli_real_escape_string($conn, $_POST['method-payment']);
    if ($payment_method === 'momo') {
        header("Location: momo_php/atm_momo.php");
    }

    if ($payment_method === 'vnpay') {
        header("Location: vnpay_php/vnpay_pay.php");
    }
}
