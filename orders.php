<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit(); // Prevent further execution
}

if (isset($_GET['cancel_order'])) {
    $order_id = $_GET['cancel_order'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$order_id' AND user_id = '$user_id'") or die(mysqli_error($conn));
    header('location:orders.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   
   <h3>Your Orders</h3>
   <p> <a href="home.php">Home</a> / Orders </p>
</div>

<section class="placed-orders">

   <h1 class="title">Placed Orders</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die(mysqli_error($conn));

         if (mysqli_num_rows($order_query) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($order_query)) {
               // Ensure payment_status exists to avoid undefined index notice
               $payment_status = isset($fetch_orders['payment_status']) ? $fetch_orders['payment_status'] : 'pending';
      ?>
      <div class="box">
         <p> <strong>Placed On:</strong> <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> <strong>Name:</strong> <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> <strong>Number:</strong> <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> <strong>Email:</strong> <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> <strong>Address:</strong> <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> <strong>Payment Method:</strong> <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> <strong>Your Orders:</strong> <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> <strong>Total Price:</strong> <span>₹<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> <strong>Payment Status:</strong> 
            <span style="color:<?php echo ($payment_status == 'pending') ? 'red' : 'green'; ?>;">
               <?php echo ucfirst($payment_status); ?>
            </span> 
         </p>
         <a href="orders.php?cancel_order=<?php echo $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to cancel this order?');">Cancel Order</a>
      </div>
      <?php
         }
      } else {
         echo '<p class="empty">No orders placed yet!</p>';
      }
      ?>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- Custom JS File Link -->
<script src="js/script.js"></script>

</body>
</html>
