<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}



if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   #$product_author = $_POST['product_author'];
   #$product_type = $_POST['product_type'];
   #$product_edition = $_POST['product_edition'];
   #$product_inventory = $_POST['product_inventory'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $inventory = mysqli_query($conn, "SELECT inventory FROM products where name='$product_name'") or die('query failed');
   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM cart WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($check_cart_numbers) > 0){
      #$message[] = '已經在購物車裡了!';
      echo '<script>alert("已經在購物車裡了")</script>'; 
      
   }
   else{
      while ($row = $inventory->fetch_assoc()) {
         #echo $row['inventory']."<br>";
         if($product_quantity<=$row['inventory']){
            mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
            #$message[] = '成功添加至購物車';
            echo '<script>alert("成功添加啦!")</script>'; 
         }
         else{
            #$message[] = '庫存不足';
            echo '<script>alert("庫存不足")</script>'; 
         }
      }
   }
}


// Get the selected category from the URL parameter
if (isset($_GET['category'])) {
   $selected_category = $_GET['category'];
   $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category = '$selected_category'") or die('query failed');
} else {
   $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>搜尋你想要的書目</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
       <h3>搜尋你想要的書目</h3>
       <p> <a href="home.php">首頁</a> / 搜尋 </p>
   </div>
   <section class="search-form">
       <form action="" method="post">
           <input type="text" name="search" placeholder="搜尋書名、作者、書本種類、實體書、電子書..." class="box">
           <input type="submit" name="submit" value="搜尋" class="btn">
       </form>
   </section>

   <div class="container">
       <section class="search-menu">
           <div class="categories">
           <b><font size="6">書本種類 </font></b><br>
           <ul>
           <b><font size="5"><a href="?category=文學小說">文學小說</a></font></b><br>
           <b><font size="5" color="blue"><a href="?category=語言學習">語言學習</a></font></b><br>
           <b><font size="5"><a href="?category=心靈成長">心靈成長</a></font></b><br>
           <b><font size="5"><a href="?category=自然科學">自然科學</a></font></b><br>
           <b><font size="5"><a href="?category=商業理財">商業理財</a></font></b><br>
           <b><font size="5"><a href="?category=教育">教育</a></font></b><br>
           <b><font size="5"><a href="?category=飲食與健康">飲食與健康</a></font></b><br>
           <b><font size="5"><a href="?category=旅遊">旅遊</a></font></b><br>
           </ul>
                 </div>
           <div class="products-container">
               <div class="box-container">
                   <?php
                   if (isset($_POST['submit'])) {
                       $search_item = $_POST['search'];
                       $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%' OR author LIKE '%{$search_item}%' OR  type LIKE '%{$search_item}%' OR  category LIKE '%{$search_item}%' ") or die('query failed');
                       if (mysqli_num_rows($select_products) > 0) {
                           while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                               ?>
                               <form action="" method="post" class="box">
                                   <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" class="image">
                                   <div class="name"><?php echo $fetch_product['name']; ?></div>
                                   <div class="price">$<?php echo $fetch_product['price']; ?></div>
                                   <div class="author">作者: <?php echo $fetch_product['author']; ?></div>
                                   <div class="edition">版本: <?php echo $fetch_product['edition']; ?></div>
                                   <div class="type">閱讀類型: <?php echo $fetch_product['type']; ?></div>
                                   <div class="category">書本種類: <?php echo $fetch_product['category']; ?></div>
                                   <div class="inventory">庫存: <?php echo $fetch_product['inventory']; ?></div>
                                   <input type="number" class="qty" name="product_quantity" min="1" value="1">
                                   <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                   <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                   <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                   <input type="submit" class="btn" value="加入購物車" name="add_to_cart">
                               </form>
                       <?php
                           }
                       }
                   }
                   ?>
                   <?php
                   if (mysqli_num_rows($select_products) > 0) {
                       while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                           ?>
                           <form action="" method="post" class="box">
                               <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" class="image">
                               <div class="name"><?php echo $fetch_product['name']; ?></div>
                               <div class="price">$<?php echo $fetch_product['price']; ?></div>
                               <div class="author">作者: <?php echo $fetch_product['author']; ?></div>
                               <div class="edition">版本: <?php echo $fetch_product['edition']; ?></div>
                               <div class="type">閱讀類型: <?php echo $fetch_product['type']; ?></div>
                               <div class="category">書本種類: <?php echo $fetch_product['category']; ?></div>
                               <div class="inventory">庫存: <?php echo $fetch_product['inventory']; ?></div>
                               <input type="number" class="qty" name="product_quantity" min="1" value="1">
                               <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                               <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                               <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                               <input type="submit" class="btn" value="加入購物車" name="add_to_cart">
                           </form>
                   <?php
                       }
                   } else {
                       echo '<p class="empty">沒有搜尋結果!</p>';
                   }
                   ?>
               </div>
           </div>
       </section>
   </div>

   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>商城</h3>
   <p> <a href="home.php">首頁</a> / 商城 </p>
</div>

<section class="products">

   <h1 class="title">新書上架!</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">$<?php echo $fetch_products['price']; ?></div>
      <div class="author">作者:<?php echo $fetch_products['author']; ?></div>
      <div class="edition">版本:<?php echo $fetch_products['edition']; ?></div>
      <div class="type">種類:<?php echo $fetch_products['type']; ?></div>
      <div class="inventory">庫存:<?php echo $fetch_products['inventory']; ?></div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="加入購物車" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
