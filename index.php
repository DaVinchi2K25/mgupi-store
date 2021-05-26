<!DOCTYPE HTML>
<html>
 <head>
  <link href="styles/style.css" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <meta name="google-site-verification" content="BNgmQkIm56Yef4swFEBvOUxQYrbr6hWplf4MRz-zNRA" />
  <meta charset="utf-8">
  <?php session_start(); ?>
  <title>Магазин электроники</title>
    </head>
    <body>
  <div class="logoblock">
<<<<<<< HEAD
  <a href="/"><img class="logomain" src="/logos/cover-cut.png"></a>
   <?php 
   if(empty($_SESSION['login'])){
  echo '<div class="usersbut">
=======
  <a href='/index.php?id=$obj->id'>
  <img class="logomain" src="/logos/cover-cut.png">
  </a>
   <div class="usersbut">
>>>>>>> 4b7e761 (123)
    <form class="btn" action="login.php" type="get">
    <p><input type="submit" value="Войти"></p>
    </form>
    <form class="btn" action="register.php" type="get">
    <p><input type="submit" value="Зарегистрироваться"></p>
  </form>';
  }
  if (!empty($_SESSION['login'])){
    echo '
      <div class="cart_block">
      <a class="logout" href="/logout.php">Выйти</a>
      <form class="btn" action="cart.php" type="get">
      <p><input type="submit" value="Корзина"></p>
      </form>
  </div>';}
  ?>
  </div>
  </div>
  <div class="main">
    <?php
  echo "<div class='category_rows'>";
  require_once 'register/connection.php'; //подключаем скрипт
  $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка" . mysqli_connect_error($link));
  $query ="SELECT * FROM `category`;";
  mysqli_set_charset($link, 'utf8mb4');
  $result = mysqli_query($link, $query) or die(mysqli_error($link)); 
  while ($obj = mysqli_fetch_object($result)){
  echo "<div class='category_row'>
          <form action='/index.php' method='POST'>
          <input type='id' value='$obj->id' name='category_id' display:none>
          <input type='submit' value='$obj->name'></form>
          </div>";
  }
  echo "</div>";
  mysqli_close($link);
  ?>

  <?php
  echo "<div class=center>";
  require_once 'register/connection.php';
  function showProducts($result){
    echo '<div class="product_rows">';
    while ($obj = mysqli_fetch_object($result)){
    echo "<div class='product_row' >
          <div class='product_name'>
          <a href='/product.php?id=$obj->id'>$obj->name</a>
          </div>
          <div class='product_img'>
          <a href='/product.php?id=$obj->id'>
          <img src=$obj->picture alt='' width='200' height='222'>
          </a>
          </div>
          <div class='product_price'>
          <h4>$obj->price руб.</h4>
          </div>
          </div>";
  }
  echo"</div>";
  }
  if(!empty($_POST)){
    $category_id = $_POST['category_id'];
      $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка" . mysqli_connect_error($link));
      mysqli_set_charset($link, 'utf8mb4');
      $query ="SELECT * FROM `sub_category` where category_id=$category_id;";
      $result = mysqli_query($link, $query) or die(mysqli_error($link));
      echo "<div class='sub_category_rows'>";
      while ($obj = mysqli_fetch_object($result)){
      echo "<div class='sub_category_row'>
          <form action='/index.php' method='POST'>
          <input type='id' value='$obj->id' name='sub_category_id' display:none>
          <input type='submit' value='$obj->name'></form>
          </div>";
      }
      echo "</div>";
    if(empty($_POST['sub_category_id']))
    {
        $query ="SELECT * FROM `products` where category_id=$category_id;";
        $result = mysqli_query($link, $query) or die(mysqli_error($link)); 
        showProducts($result);
    }
    else
    {
      $link = mysqli_connect($host, $user, $password, $database) 
      or die("Ошибка" . mysqli_connect_error($link));
      mysqli_set_charset($link, 'utf8mb4');
      $query ="SELECT * FROM `products`;";
      $result = mysqli_query($link, $query) or die(mysqli_error($link)); 
      showProducts($result);
    }
    }
    else 
    {
      $link = mysqli_connect($host, $user, $password, $database) 
      or die("Ошибка" . mysqli_connect_error($link));
      mysqli_set_charset($link, 'utf8mb4');
      $query ="SELECT * FROM `products`;";
      $result = mysqli_query($link, $query) or die(mysqli_error($link)); 
      showProducts($result);
    }
    echo "</div>";
    ?>
</div>
</div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(76681208, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/76681208" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>