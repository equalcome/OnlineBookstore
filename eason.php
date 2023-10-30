<?php session_start();?>
<?php

include 'config.php';



$user_id = $_SESSION['user_id'];
echo $user_id;
//紀錄vip狀態

#存 is_vip to user_query
$user_query = mysqli_query($conn, "SELECT is_vip FROM `users` WHERE id = '$user_id'")or die('query failed');
#echo $user_query."<br>";
#令$is_vip存use_query裡的is_vip值(我不知道為啥php要用這樣寫)，只會執行一次就會get null跳出的迴圈
while ($vip = $user_query->fetch_assoc()) {
   #echo $vip['is_vip'];
   $is_vip=$vip['is_vip'];
}
   #echo $vip['is_vip']."<br>";
   #if($vip['is_vip']==1){
   
#echo $is_vip;
#if (mysqli_num_rows($user_query) > 0) {
#   $user = mysqli_fetch_assoc($user_query);
#   $is_vip = $user['is_vip'];
#}
#echo "<script>var isVip = " . $is_vip . ";</script>";
#echo $is_vip; 

#$_SESSION['is_vip'] = $is_vip;
#echo $is_vip; 

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['order_btn'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $shipping_method = mysqli_real_escape_string($conn, $_POST['shipping_method']);
   $address = mysqli_real_escape_string($conn, '  ' . $_POST['street'] .  '  ' . $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products = [];

   $cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die('query failed');
   if (mysqli_num_rows($cart_query) > 0) {
      while ($cart_item = mysqli_fetch_assoc($cart_query)) {
         $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ', $cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM orders WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND shipping_method = '$shipping_method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if ($cart_total == 0) {
      $message[] = '購物車是空的';
   } else {
      if (mysqli_num_rows($order_query) > 0) {
         $message[] = '訂單已加入';
      } else {
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, shipping_method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$shipping_method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = '訂購成功!';
         mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'") or die('query failed');
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
   <title>結帳頁</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .btn {
         background-color: blueviolet;
         color: white;
      }

      .original-price {
         text-decoration: line-through;
         color: #888;
      }

      .discounted-price {
         color: #c00;
      }

      #apply_coupon {
  background-color: orchid;
  color: white;
  margin-left: 5px;
}
 body {
      font-size: 24px; /* 调整整体字体大小 */
   }

   h3 {
      font-size: 24px; /* 调整标题字体大小 */
   }
   </style>
</head>

<body>
   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>結帳</h3>
      <p><a href="home.php">首頁</a> / 結帳頁</p>
   </div>

   <section class="display-order">
      <?php
      
      $cart_total = 0;
      $discounted_total = 0; // Variable to hold the discounted price
      $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die('query failed');
      if (mysqli_num_rows($select_cart) > 0) {
         while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $cart_total += $total_price;
            #如果$is_vip==1 那就會變成9折
            if($is_vip==1){
               $cart_total=floor(0.9*$cart_total);
               mysqli_query($conn, "UPDATE `orders` SET total_price = '$cart_total' WHERE id = '$cart_id'") or die('query failed');
            }
            
         }
      }

      // Apply coupon code discount if applicable
      /*$coupon_code = isset($_POST['coupon_code']) ? $_POST['coupon_code'] : '';
      if ($coupon_code === 'COUPON123' && $is_vip===1) {
         // Apply a 20% discount for the coupon code 'COUPON123'
         $discount_percentage = 28;
         $discount = $grand_total * ($discount_percentage / 100);
         $discounted_total = $grand_total - $discount;
      }
     else  if ($coupon_code === 'COUPON456' && $is_vip===1) {
        // Apply a 20% discount for the coupon code 'COUPON123'
        $discount_percentage = 37;
        $discount = $grand_total * ($discount_percentage / 100);
        $discounted_total = $grand_total - $discount;
     }

   else  if ($coupon_code === 'COUPON789' && $is_vip===1) {
        // Apply a 20% discount for the coupon code 'COUPON123'
        $discount_percentage = 46;
        $discount = $grand_total * ($discount_percentage / 100);
        $discounted_total = $grand_total - $discount;
     }
     if ($coupon_code === 'COUPON123' && $is_vip===0) {
      // Apply a 20% discount for the coupon code 'COUPON123'
      $discount_percentage = 20;
      $discount = $grand_total * ($discount_percentage / 100);
      $discounted_total = $grand_total - $discount;
   }
  else  if ($coupon_code === 'COUPON456' && $is_vip===0) {
     // Apply a 20% discount for the coupon code 'COUPON123'
     $discount_percentage = 30;
     $discount = $grand_total * ($discount_percentage / 100);
     $discounted_total = $grand_total - $discount;
  }

else  if ($coupon_code === 'COUPON789' && $is_vip===0) {
     // Apply a 20% discount for the coupon code 'COUPON123'
     $discount_percentage = 40;
     $discount = $grand_total * ($discount_percentage / 100);
     $discounted_total = $grand_total - $discount;
  }*/
$_SESSION["checkout_discounted_total"] = $discounted_total;

      // Display the appropriate total amount to the user
      if ($discounted_total > 0) {
         echo "<div class='grand-total'>Total Amount: <span class='original-price'>$" . $discounted_total . "/-</span> <span class='discounted-price'>$" . $discounted_total . "/-</span></div>";
      } else {
         echo "<div class='grand-total'>Total Amount: $" . $cart_total . "/-</div>";
      }
      ?>
      <style>
         .original-price {
            text-decoration: line-through;
            color: #888;
         }

         .discounted-price {
            color: #c00;
         }
      </style>
      <div class="grand-total"> 總金額 : <span>$<?php echo $cart_total; ?>/-</span> </div>

   </section>

   <section class="checkout">
      <form action="" method="post">
         <h3>您的訂單</h3>
         <div class="flex">
            <div class="inputBox">
               <span>姓名 :<span class="required-field-text" style="color:#CB8A90; font-size: 6px;"> *此為必填</span></span>
               <input type="text" name="name" required placeholder="輸入姓名">
            </div>
            <div class="inputBox">
               <span>電話 :<span class="required-field-text" style="color:#CB8A90; font-size: 6px;"> *此為必填</span></span>
               <input type="number" name="number" required placeholder="輸入號碼">
            </div>
            <div class="inputBox">
               <span>email :<span class="required-field-text" style="color:#CB8A90; font-size: 6px;"> *此為必填</span></span>
               <input type="email" name="email" required placeholder="輸入email">
            </div>
            <div class="inputBox">
               <span>運送方式 :</span>
               <select name="shipping_method">
                  <option value="到店取貨">到店取貨</option>
                  <option value="超商取貨">超商取貨</option>
                  <option value="宅配到府">宅配到府</option>
               </select>
            </div>
            <div class="inputBox">
               <span>付款方式 :</span>
               <select name="method">
                  <option value="貨到付款">貨到付款</option>
                  <option value="信用卡">信用卡</option>
                  <option value="paypal">paypal</option>
               </select>
            </div>
            <div class="inputBox">
               <span>住址 :<span class="required-field-text" style="color:#CB8A90; font-size: 6px;"> *此為必填</span></span>
            <input type="text" name="street" required placeholder="請輸入地址">
         </div>
         <div class="inputBox">
            <span>郵遞區號 :<span class="required-field-text" style="color:#CB8A90; font-size: 6px;"> *此為必填</span></span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 114">
         </div>
         <div class="inputBox">
            <span>coupon_code :</span>
            <input type="text" name="coupon_code" id="coupon_code" placeholder="輸入coupon_code">
            <button type="button" id="apply_coupon">Apply</button>
         </div>
      </div>
      <div id="total_amount" class="grand-total"></div>
      <input type="submit" value="下單" class="btn" name="order_btn">
   </form>

   
</section>


   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

   </body>

   </html>