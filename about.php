<?php
#test
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
   <link rel="icon" href="images/favicon.ico" />
</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>關於我們</h3>
   <p> <a href="home.php">首頁</a> / 關於我們 </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>書和恩書局</h3>
         <p>1915年創立至今，歷經100多年的耕耘，中央大學已成為國內少數歷史悠久、校景優美且校譽優良之頂尖大學。目前學生人數約1萬2000人，培育出許多優秀校友，為國家貢獻良多。</p>
         <p>「誠於學問，樸於人生」，我們期許能夠帶領本校師生在這個景色優美且擁有深厚文化底蘊之校園建構出人文關懷及學術研究並重的環境，提供給學生國際化且多元的的學習體驗，成為一所極具特色的世界一流大學。</p>
         <a href="contact.php" class="btn">聯絡我們</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">顧客反饋</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.jpg" alt="">
         <p>好棒很棒超級棒</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>嗨嗨嗨嗨</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.jpg" alt="">
         <p>好棒很棒超級棒</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>嗨嗨嗨嗨</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.jpg" alt="">
         <p>好棒很棒超級棒</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>嗨嗨嗨嗨</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.jpg" alt="">
         <p>好棒很棒超級棒</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>嗨嗨嗨嗨</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.jpg" alt="">
         <p>好棒很棒超級棒</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>嗨嗨嗨嗨</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.jpg" alt="">
         <p>好棒很棒超級棒</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>嗨嗨嗨嗨</h3>
      </div>

   </div>

</section>

<section class="authors">

   <h1 class="title">合作作家</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/author1-1.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>嗨嗨嗨嗨</h3>
      </div>

      <div class="box">
         <img src="images/author1-2.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>嗨嗨嗨嗨</h3>
      </div>

      <div class="box">
         <img src="images/author1-3.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>嗨嗨嗨嗨</h3>
      </div>

      <div class="box">
         <img src="images/author1-4.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>嗨嗨嗨嗨</h3>
      </div>

      <div class="box">
         <img src="images/AUTHOR1-7.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="https://instagram.com/dobdobar_0720?igshid=MjEwN2IyYWYwYw==" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>嗨嗨嗨嗨</h3>
      </div>

      <div class="box">
         <img src="images/author1-6.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>嗨嗨嗨嗨</h3>
      </div>

   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
