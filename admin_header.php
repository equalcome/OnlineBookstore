<?php
// 在你的PHP文件的顶部，添加会话开始的代码
session_start();

// 模拟用户数据，假设用户ID为2有权限
$allowedUserIds = [2];

// 检查用户是否登录
if(isset($_SESSION['admin_id'])){
    $currentUserId = $_SESSION['admin_id'];

    // 检查用户ID是否在允许的ID数组中
    if(in_array($currentUserId, $allowedUserIds)){
        // 用户有权限，显示链接
        $isAdminLinkVisible = true;
    } else {
        // 用户没有权限，不显示链接
        $isAdminLinkVisible = false;
    }
} else {
    // 用户没有登录，不显示链接
    $isAdminLinkVisible = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <!-- 添加你的样式和脚本链接等 -->
</head>
<body>

<header class="header">
    <div class="flex">
        <a href="admin_page.php" class="logo"><b>管理<span>後台</span></b></a>
        <nav class="navbar">
            <a href="admin_page.php"><b>首頁</b></a>
            <a href="admin_products.php"><b>產品總覽</b></a>
            <a href="admin_orders.php"><b>訂單管理</b></a>
            <a href="admin_users.php"><b>使用者</b></a>
            
            <?php
            // 根据权限决定是否显示"管理者"链接
            if($isAdminLinkVisible) {
                echo '<a href="admin_admins.php"><b>管理者</b></a>';
            }
            ?>

            <a href="admin_contacts.php"><b>訊息一覽</b></a>
            <a href="admin_coupon.php"><b>折扣券總覽</b></a>
        </nav>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>
        <div class="account-box">
            <?php
            // 如果用户已登录，显示用户信息和操作链接
            if(isset($_SESSION['admin_id'])){
                echo '<p>username : <span>' . $_SESSION['admin_name'] . '</span></p>';
                echo '<p>email : <span>' . $_SESSION['admin_email'] . '</span></p>';
                echo '<a href="logout.php" class="delete-btn">logout</a>';
                // 其他用户相关信息和操作链接
            } else {
                // 用户没有登录，显示登录和注册链接
                echo 'new <a href="login.php">login</a> | <a href="register.php">register</a>';
            }
            ?>
        </div>
    </div>
</header>

<!-- 其他页面内容 -->

</body>
</html>