<!DOCTYPE HTML>
<html>
 <head>
  <link href="styles/style.css" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <meta charset="utf-8">
  <?php session_start(); ?>
  <title>Магазин электроники</title>
    </head>
    <body>
  <div class="logoblock">
      <a href="/"><img class="logomain" src="/logos/cover-cut.png"></a>
   <?php
   function showProducts($result)
   {
       echo '<div class="cart">';
       while ($obj = mysqli_fetch_object($result)) {
           echo "<div class='product_row' >
          <div class='product_name'>
          <a href='/product.php?id=$obj->id'>$obj->name</a>
          </div>
          <div class='product_img'>
          <a href='/product.php?id=$obj->id'>
          <img src=$obj->picture alt='' width='200' height='222'>
          </a>
          </div>
          <div class='product_text'>
          <b>$obj->text</b>
          </div>
          <div class='product_price'>
          <h4>$obj->price руб.</h4>
          </div>
          </div>";
       }
   }
   if(empty($_SESSION['login'])){
  echo '<div class="usersbut">
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
  echo '</div>';
  if (!empty($_SESSION)){
      require_once 'register/connection.php';
      $link = mysqli_connect($host, $user, $password, $database)
      or die("Ошибка" . mysqli_connect_error($link));
      mysqli_set_charset($link, 'utf8mb4');
      $query = "SELECT cart FROM `users` WHERE `email`='".$_SESSION['login']."';";
      $result = mysqli_query($link, $query) or die(mysqli_error($link));
      $obj = mysqli_fetch_object($result);
      $cart = $obj->cart;
      $cart = explode ( ' ' ,$cart);
      $query = "SELECT * FROM `products` WHERE id='0'";
      foreach ($cart as $product){
          $query .=" or id='".$product."'";
      }
      $query .=";";
      $result = mysqli_query($link, $query) or die(mysqli_error($link));
      showProducts($result);
      mysqli_close($link);
  }
  ?>
</div>
</body>
</html>