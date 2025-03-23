<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <p> new <a href="/login.php">login</a> | <a href="/register.php">register</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a href="/home.php" class="logo">Bookflix.</a>

         <nav class="navbar">
            <a href="/home.php">Home</a>
            <a href="/adapted.php">Adapted</a>
            <a href="/non-adapted.php">Non-Adapted</a>
            <a href="/about.php">About</a>
            <a href="/shop.php">Shop</a>
            <a href="/contact.php">Contact</a>
            <a href="/orders.php">Orders</a>
            
            <!-- Genre Dropdown -->
            <div class="dropdown">
               <a href="#" class="dropbtn">Genre <i class="fas fa-chevron-down"></i></a>
               <div class="dropdown-content">
                  <a href="#">Drama and Romance</a>
                  <a href="#">Thriller andMystery</a>
                  <a href="#">Fantasy and Sci-fi</a>
                  <a href="#">Historical and Priod Stories</a>
                  <a href="#">Horror and Supernatural</a>
               </div>
            </div>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <div class="user-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="/logout.php" class="delete-btn">logout</a>
         </div>
      </div>
   </div>

</header>

<style>
   .dropdown {
      position: relative;
      display: inline-block;
   }

   .dropbtn {
      text-decoration: none;
      color: black;
      padding: 10px;
      display: inline-block;
   }

   .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 160px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
      z-index: 10;
      border-radius: 5px;
   }

   .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
   }

   .dropdown-content a:hover {
      background-color: #f4f4f4;
   }

   .dropdown:hover .dropdown-content {
      display: block;
   }
</style>
