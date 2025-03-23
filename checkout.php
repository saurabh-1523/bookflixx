<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

$temp_cart = [];

if (isset($_POST['shop_now'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    // Add the product to a temporary cart for checkout
    $temp_cart[] = [
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => $product_quantity,
        'image' => $product_image
    ];
} else {
    // Fetch items from the actual cart
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die(mysqli_error($conn));
    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
        $temp_cart[] = $fetch_cart;
    }
}

if (isset($_POST['order_btn'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = $_POST['number'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'Flat No. '. $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code']);
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products = [];

    foreach ($temp_cart as $cart_item) {
        $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
        $sub_total = ($cart_item['price'] * $cart_item['quantity']);
        $cart_total += $sub_total;
    }

    $total_products = implode(', ', $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die(mysqli_error($conn));

    if ($cart_total == 0) {
        $message[] = 'Your cart is empty';
    } else {
        if (mysqli_num_rows($order_query) > 0) {
            $message[] = 'Order already placed!'; 
        } else {
            mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die(mysqli_error($conn));
            $message[] = 'Order placed successfully!';
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die(mysqli_error($conn));
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
    <h3>Checkout</h3>
    <p> <a href="home.php">Home</a> / Checkout </p>
</div>

<section class="display-order">

    <?php  
        $grand_total = 0;
        if (!empty($temp_cart)) {
            foreach ($temp_cart as $fetch_cart) {
                $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                $grand_total += $total_price;
    ?>
    <p><?php echo $fetch_cart['name']; ?> <span>(<?php echo '₹'.$fetch_cart['price'].' x '. $fetch_cart['quantity']; ?>)</span></p>
    <?php
            }
        } else {
            echo '<p class="empty">Your cart is empty</p>';
        }
    ?>
    <div class="grand-total"> Grand Total: <span>₹<?php echo $grand_total; ?></span> </div>

</section>

<section class="checkout">

    <form action="" method="post">
        <h3>Place Your Order</h3>
        <div class="flex">
            <div class="inputBox">
                <span>Your Name :</span>
                <input type="text" name="name" required placeholder="Enter your name">
            </div>
            <div class="inputBox">
                <span>Your Number :</span>
                <input type="number" name="number" required placeholder="Enter your number">
            </div>
            <div class="inputBox">
                <span>Your Email :</span>
                <input type="email" name="email" required placeholder="Enter your email">
            </div>
            <div class="inputBox">
                <span>Payment Method :</span>
                <select name="method">
                    <option value="Cash on Delivery">Cash on Delivery</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="UPI">UPI</option>
                    <option value="Net Banking">Net Banking</option>
                </select>
            </div>
            <div class="inputBox">
                <span>Flat No. :</span>
                <input type="text" name="flat" required placeholder="e.g. Flat No. 101">
            </div>
            <div class="inputBox">
                <span>Street Name :</span>
                <input type="text" name="street" required placeholder="e.g. Street Name">
            </div>
            <div class="inputBox">
                <span>City :</span>
                <input type="text" name="city" required placeholder="e.g. Mumbai">
            </div>
            <div class="inputBox">
                <span>State :</span>
                <input type="text" name="state" required placeholder="e.g. Maharashtra">
            </div>
            <div class="inputBox">
                <span>Country :</span>
                <input type="text" name="country" required placeholder="e.g. India">
            </div>
            <div class="inputBox">
                <span>Pin Code :</span>
                <input type="number" name="pin_code" required placeholder="e.g. 123456">
            </div>
        </div>
        <input type="submit" value="Order Now" class="btn" name="order_btn">
    </form>

</section>

<?php include 'footer.php'; ?>

<!-- Custom JS -->
<script src="js/script.js"></script>

</body>
</html>
