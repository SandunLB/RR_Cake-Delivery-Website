<?php

@include 'config.php';

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
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>about us</h3>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/AAA.webp" alt="">
        </div>

        <div class="content">
            <h3>Why Choose Us?</h3>
            <p>At RR bakery, we understand that every celebration deserves something special. That's why we strive to create cakes that not only look stunning but also taste divine. With our dedication to quality and craftsmanship, we ensure that every cake we bake becomes the centerpiece of your memorable moments.</p>
            
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>What We Provide?</h3>
            <p>Our range of delectable cakes caters to every occasion, from birthdays and weddings to anniversaries and corporate events. Whether you're craving a classic chocolate cake, a whimsical fondant masterpiece, or a custom-designed creation, we have something to delight every palate. With our commitment to using the finest ingredients and innovative techniques, we guarantee a cake that exceeds your expectations.</p>
            
        </div>

        <div class="image">
            <img src="images/birthday-cake-happy-birthday-cake-birthday-cake-transparent-background-ai-generative-free-png.webp" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="images/chocolate-cake-happy-birthday-chocolate-cake-ai-generative-free-png.webp" alt="">
        </div>

        <div class="content">
            <h3>Who We Are?</h3>
            <p>At the heart of RR is a team of passionate bakers and artists who share a love for all things sweet. With years of experience and a flair for creativity, our talented team brings your cake dreams to life. We take pride in our attention to detail, ensuring that each cake is not only visually stunning but also a true reflection of your personality and style.</p>
            
        </div>

    </div>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>