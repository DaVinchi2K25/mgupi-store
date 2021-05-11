<!DOCTYPE HTML>
<html>
 <head>
  <link href="styles/product.css" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link href="styles/style.css" rel="stylesheet" type="text/css">
  <style type="text/css">
   .hidden{ 
    display: none;
   }
  </style>
  <meta charset="utf-8">
  <?php session_start(); ?>
  <title>Магазин электроники</title>
    </head>
    <body>
  <div class="logoblock">
  <a href="/"><img class="logomain" src="/logos/cover-cut.png"></a>
   <?php 
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
  ?>
  </div>
  </div>
	<div class="product">
		<?php
		require_once 'register/connection.php';
		if(!empty($_GET)){
			$product_id=$_GET['id'];
			$link = mysqli_connect($host, $user, $password, $database) 
    		or die("Ошибка" . mysqli_connect_error($link));
    		mysqli_set_charset($link, 'utf8mb4');
			$query ="SELECT id,name,picture,price,text FROM `products` where id =$product_id;";
			$result = mysqli_query($link, $query) or die(mysqli_error($link)); 
			$obj = mysqli_fetch_object($result);
			echo "<div class='product'>
			<div class='product_name'>
			<b>$obj->name</b>
			</div>
			<div class='product_img'>
			<img src=$obj->picture>
			</div>
			<div class='product_price'>
			<h4>$obj->price руб.</h4>
			</div>
			<div class='product_text'>
			<p>$obj->text</p>
			</div>
      <form method='get'>
      <input class='hidden' name='buy' value='yes' >
      <input class='hidden' name='id'  value='$obj->id'>
      <input type='submit' value='в корзину'>
      </form>
			</div>";
			if(!empty($_GET['buy'])) {
			    $product_id=$_GET['id'];
                $email = $_SESSION['login'];
                $query = "SELECT cart FROM `users` WHERE `email`='$email';";
                $result = mysqli_query($link, $query) or die(mysqli_error($link));
                $obj = mysqli_fetch_object($result);
                $cart = $obj->cart.' '.$product_id;
                $query ="UPDATE `users` SET `cart`='$cart' WHERE `email`='$email';";
                mysqli_query($link, $query) or die(mysqli_error($link));
            }
			}
        mysqli_close($link);
		?>
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