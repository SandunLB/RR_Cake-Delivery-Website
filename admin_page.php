<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="dashboard">
   <h1 class="title">Dashboard</h1>
   <div class="table-container">
      <table class="dashboard-table">
         <tr>
            <th>Orders Placed</th>
            <td>
               <?php
                  $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                  $number_of_orders = mysqli_num_rows($select_orders);
                  echo $number_of_orders;
               ?>
            </td>
         </tr>
         <tr>
            <th>Products Added</th>
            <td>
               <?php
                  $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                  $number_of_products = mysqli_num_rows($select_products);
                  echo $number_of_products;
               ?>
            </td>
         </tr>
         <tr>
            <th>Users</th>
            <td>
               <?php
                  $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
                  $number_of_users = mysqli_num_rows($select_users);
                  echo $number_of_users;
               ?>
            </td>
         </tr>
         <tr>
            <th>Admins</th>
            <td>
               <?php
                  $select_admin = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                  $number_of_admin = mysqli_num_rows($select_admin);
                  echo $number_of_admin;
               ?>
            </td>
         </tr>
         <tr>
            <th>Total Accounts</th>
            <td>
               <?php
                  $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                  $number_of_account = mysqli_num_rows($select_account);
                  echo $number_of_account;
               ?>
            </td>
         </tr>
         <tr>
            <th>New Messages</th>
            <td>
               <?php
                  $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                  $number_of_messages = mysqli_num_rows($select_messages);
                  echo $number_of_messages;
               ?>
            </td>
         </tr>
      </table>
   </div>
</section>

<script src="js/admin_script.js"></script>

</body>
</html>