<?php
include 'config.php';



session_start();

$admin_id = $_SESSION['admin_id'];


if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

// 新增以下代碼段，處理VIP設定
if (isset($_GET['set_vip'])) {
   $vip_id = $_GET['set_vip'];
   mysqli_query($conn, "UPDATE `users` SET is_vip = 1 WHERE id = '$vip_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title"> 使用者帳號總覽 </h1>

   <div class="box-container">
      <?php
      $select_users = mysqli_query($conn, "SELECT * FROM `users`WHERE user_type = 'user'") or die('query failed');
      while ($fetch_users = mysqli_fetch_assoc($select_users)) {
         ?>
         <div class="box">
            <p> 編號 : <span><?php echo $fetch_users['id']; ?></span> </p>
            <p> 姓名 : <span><?php echo $fetch_users['name']; ?></span> </p>
            <p> email : <span><?php echo $fetch_users['email']; ?></span> </p>
            <p> 使用者類型 : <span style="color:<?php if ($fetch_users['user_type'] == 'admin') {
                  echo 'var(--orange)';
               } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
            <?php
            // 檢查是否為VIP
            if ($fetch_users['is_vip'] == 1) {
               echo '<p> VIP : <span style="color: var(--green);">是</span></p>';
            } else {
               echo '<p> VIP : <span style="color: var(--red);">否</span></p>';
            }
            ?>
            
            <div style="text-align: center; margin-top: 20px; margin-bottom: 20px;">
            <a href="admin_order_id.php?user_id=<?php echo $fetch_users['id']; ?>" class="btn btn-primary">訂單查詢</a>
            </div>
            
            
            <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">刪除該使用者</a>
            <div>
            <?php
            // 顯示VIP設定按鈕
            if ($fetch_users['is_vip'] == 0) {
               // If the user is not a VIP, generate a link/button to set them as a VIP
               echo '<a href="admin_users.php?set_vip=' . $fetch_users['id'] . '" class="btn btn-warning vip-btn">設為VIP</a>';
           } else {
               // If the user is already a VIP, generate a disabled link/button indicating so
               echo '<a href="#" class="btn btn-success vip-btn disabled">已是VIP</a>';
           }
            ?>
            </div>
         </div>
      <?php
      };
      ?>
   </div>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>