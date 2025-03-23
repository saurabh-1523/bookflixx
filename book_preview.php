<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    $select_book = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$book_id'") or die('query failed');
    if (mysqli_num_rows($select_book) > 0) {
        $fetch_book = mysqli_fetch_assoc($select_book);
    } else {
        echo '<p class="empty">No book found!</p>';
    }
} else {
    header('location:adapted.php');
    exit();
}

if (isset($_POST['add_to_cart'])) {
    $product_name = $fetch_book['name'];
    $product_price = $fetch_book['price'];
    $product_image = $fetch_book['image'];
    $product_quantity = 1; // Default quantity

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart!';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'Product added to cart at ₹' . $product_price;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Preview</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="book-preview">

    <div class="box-container">

        <?php if (isset($fetch_book)) { ?>
        <div class="box">
            <img class="image" src="uploaded_img/<?php echo $fetch_book['image']; ?>" alt="<?php echo $fetch_book['name']; ?>">
            <div class="name"><?php echo $fetch_book['name']; ?></div>
            <div class="price">₹<?php echo $fetch_book['price']; ?>/-</div>
            <div class="description"><?php echo $fetch_book['description']; ?></div>
            <form action="" method="post">
                <input type="hidden" name="product_name" value="<?php echo $fetch_book['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_book['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_book['image']; ?>">
                <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
            </form>
            <form action="checkout.php" method="post">
                <input type="hidden" name="product_name" value="<?php echo $fetch_book['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_book['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_book['image']; ?>">
                <input type="hidden" name="product_quantity" value="1">
                <input type="submit" value="Shop Now" name="shop_now" class="btn">
            </form>
        </div>
        <?php } else { ?>
            <p class="empty">No book found!</p>
        <?php } ?>

    </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>