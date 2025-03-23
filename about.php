<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   

   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">


   <div class="flex">


      <div class="content">
         <h3>why choose us?</h3>
         <p>Welcome to Bookflix, your one-stop destination for discovering, previewing, and purchasing books! Whether you're a fan of stories that have been brought to life on screen or love exploring fresh literary adventures, Bookflix has something for every reader.</p>
         <P>We specialize in offering:</p>
         <p>✔ Books adapted into Netflix series or movies – Dive into the original stories behind your favorite on-screen adaptations.</p>
         <p>✔ Books yet to be adapted – Explore hidden gems and bestselling novels that might be the next big hit.</p>
         <p>📚 What We Offer</p>
         <p>🔹 Preview Before You Buy – Get a sneak peek into the book by reading the first few chapters before making a purchase.</p>
         <p>🔹 Seamless Book Purchasing – Buy books directly from our platform and enjoy a smooth and secure shopping experience.</p>
         <p>🔹 Personalized Recommendations – Discover books tailored to your interests and reading habits.</p>
         <p>🔹 Trending & Popular Books – Stay updated with the latest bestsellers, reader favorites, and top-rated books.</p>
         <p>🔹 Reviews & Ratings – Make informed decisions by checking out what other readers think.</p>
         <p>At Bookflix, we are dedicated to making your reading experience enjoyable, accessible, and engaging. Whether you’re looking for a book that inspired your favorite Netflix series or searching for your next great read, we’ve got you covered. Start exploring today and let your reading journey begin! 📖✨</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>


<section class="authors">

   <h1 class="title">great authors</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/colleen hoover.png" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Colleen Hoover</h3>
      </div>

      <div class="box">
         <img src="images\durjoy dutta.png" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Durjoy Datta</h3>
      </div>

      <div class="box">
         <img src="images/gillian flynn.png" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Gillian Flynn</h3>
      </div>

      <div class="box">
         <img src="images/nicholas sparks.png" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Nicholas Sparks</h3>
      </div>

      <div class="box">
         <img src="images/preeti shenoy.png" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Preeti Shenoy</h3>
      </div>

      <div class="box">
         <img src="images/sudeep nagarkar.png" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Sudeep Nagarkar</h3>
      </div>


   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>