<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['add_to_wishlist'])) {

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];

   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_wishlist_numbers) > 0) {
      $message[] = 'already added to wishlist';
   } elseif (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'already added to cart';
   } else {
      mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
      $message[] = 'product added to wishlist';
   }
}

if (isset($_POST['add_to_cart'])) {

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'already added to cart';
   } else {

      $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

      if (mysqli_num_rows($check_wishlist_numbers) > 0) {
         mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
      }

      mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php @include 'header.php'; ?>

   <section class="home">

      <div class="content">
         <h3>🎂 Welcome to R&R! 🍰</h3>
         <p>Indulge in sweet moments with our delectable cakes crafted with love and care. 🎉 Elevate every celebration with our irresistible flavors and stunning designs. 🌟 From birthdays to weddings, make memories sweeter with R&R. Order now and taste the magic! ✨🎈</p>
         <a href="about.php" class="btn">discover more</a>
      </div>

   </section>

   <!-- about section starts  -->

   <section class="aboutus" id="aboutus">

      <h1 class="title"> <span> about </span> us </h1>

      <div class="row">

         <div class="video-container">
            <video src="videos/video.mp4" loop autoplay muted></video>
            <h3>Best Cake Sellers</h3>
         </div>

         <div class="content">
            <h3>Why Choose Us?</h3>
            <p>Whenever you visit a bakery, you will see a selective range of cakes. Since you are obviously buying a cake for an important occasion, you will be visiting many local bakeries before choosing one special cake. If you decide to buy the cake online, you can browse through larger variety of cakes in one e-commerce shop than you would in almost all local bakeries combined.

            <div>
               <a href="#" class="btn">learn more</a>
            </div>

         </div>

      </div>

   </section>

   <section class="icons-container">

      <div class="icons">
         <img src="images/icon-1.png" alt="">
         <div class="info">
            <h3>Free Delivery</h3>
            <span>On All Locations</span>
         </div>
      </div>

      <div class="icons">
         <img src="images/icon-3.png" alt="">
         <div class="info">
            <h3>Offer & Fifts</h3>
            <span>On All Orders</span>
         </div>
      </div>

      <div class="icons">
         <img src="images/icon-4.png" alt="">
         <div class="info">
            <h3>Secure Payments</h3>
            <span>Protected Methods</span>
         </div>
      </div>

   </section>


   <section class="products">


      <div class="box-container">

         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 9") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
         ?>
               <form action="" method="POST" class="box">
                  <div class="price">Rs.<?php echo $fetch_products['price']; ?>/-</div>
                  <div class="image">
                     <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                    
                  </div>
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <input type="hidden" name="product_quantity" value="1" min="0" class="qty">
                  <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" value="&#10084;" name="add_to_wishlist" class="option-btn">
                  <input type="submit" value="add to cart" name="add_to_cart" class="btn">
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>

      </div>

      <div class="more-btn">
         <a href="shop.php" class="option-btn">View All</a>
      </div>

   </section>

   <?php @include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>