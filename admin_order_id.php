<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

// 检查是否存在用户編號
if (isset($_GET['user_id'])) {
   $user_id = $_GET['user_id'];

   // 查询该用户的订单
   $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');

   // 获取顾客姓名
   $select_user = mysqli_query($conn, "SELECT name FROM `users` WHERE id = '$user_id'");
   $fetch_user = mysqli_fetch_assoc($select_user);
   $customer_name = $fetch_user['name'];

} else {
   // 如果没有提供用户編號，则返回到订单管理页面
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo $customer_name; ?> 的訂單</title> <!-- 在标题中显示顾客姓名 -->

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php include 'admin_header.php'; ?>

   <section class="orders">

      <h1 class="title"><?php echo $customer_name; ?> 的訂單總覽</h1> <!-- 在页面中显示顾客姓名 -->

      <div class="box-container">
         <?php
         if (mysqli_num_rows($select_orders) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
               ?>
               <div class="box">
                  <p> 訂單編號 : <span><?php echo $fetch_orders['id']; ?></span> </p>
                  <p> 日期 : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                  <p> 姓名 : <span><?php echo $fetch_orders['name']; ?></span> </p>
                  <p> 電話 : <span><?php echo $fetch_orders['number']; ?></span> </p>
                  <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                  <p> 地址 : <span><?php echo $fetch_orders['address']; ?></span> </p>
                  <p> 商品總覽 : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                  <p> 金額 : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
                  <p> 付款方式 : <span><?php echo $fetch_orders['method']; ?></span> </p>
                  <p> 運送方式 : <span><?php echo $fetch_orders['shipping_method']; ?></span> </p>
                  <!-- 其他订单信息根据需要添加 -->
               </div>
            <?php
            }
         } else {
            echo '<p class="empty">此顧客尚未下訂單!</p>';
         }
         ?>
      </div>

   </section>

   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>

</body>

</html>
