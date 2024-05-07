<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $category_id = $_POST['category_id']; // Add this line to capture the selected category ID
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'uploaded_img/'.$image;

   // Check if product name already exists
   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');
   if(mysqli_num_rows($select_product_name) > 0){
      echo '<script>alert("product name already exists!");</script>';
   } else {
      // Insert product details into products table
      $insert_product = mysqli_query($conn, "INSERT INTO `products`(name, price, category_id, image) VALUES('$name', '$price', '$category_id', '$image')") or die('query failed');

      if($insert_product){
         if($image_size > 2000000){
            
         } else {
            // Upload image
            move_uploaded_file($image_tmp_name, $image_folter);
            
         }
      }
   }
}


if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');
   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="add-products">
   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add new product</h3>
      <input type="text" class="box" required placeholder="Name" name="name">
      <input type="number" min="0" class="box" required placeholder="Price (Rs.)" name="price">
      <select name="category_id" class="box" required>
         <option value="">Select Category</option>
         <?php
            // Fetch categories from the database
            $select_categories = mysqli_query($conn, "SELECT * FROM categories") or die('query failed');
            while ($fetch_categories = mysqli_fetch_assoc($select_categories)) {
               echo '<option value="' . $fetch_categories['category_id'] . '">' . $fetch_categories['name'] . '</option>';
            }
         ?>
      </select>
      <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>
</section>


<section class="show-products">
   <?php
   // Fetch categories from the database
   $select_categories = mysqli_query($conn, "SELECT * FROM categories") or die('query failed');
   while ($fetch_categories = mysqli_fetch_assoc($select_categories)) {
      echo '<div class="category">';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<h2 style="font-size: 30px; text-align: center; margin-bottom: 20px;">' . $fetch_categories['name'] . '</h2>'; // Inline styles added here
       echo '<div class="box-container">';
       // Fetch products based on category
       $category_id = $fetch_categories['category_id'];
       $select_products = mysqli_query($conn, "SELECT * FROM products WHERE category_id = $category_id") or die('query failed');
       if (mysqli_num_rows($select_products) > 0) {
           while ($fetch_products = mysqli_fetch_assoc($select_products)) {
               ?>
               <div class="box">
                  <div class="price">Rs.<?php echo $fetch_products['price']; ?>.00</div>
                  <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <a href="admin_update_product.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">&#10003;</a>
                  <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">&#10007;</a>
               </div>
               <?php
           }
       } else {
           echo '<p class="empty">No products available in this category</p>';
       }
       echo '</div>'; // Close box-container
       echo '</div>'; // Close category
   }
   ?>
</section>














<script src="js/admin_script.js"></script>

</body>
</html>