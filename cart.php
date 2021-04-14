<!DOCTYPE HTML>
<html>
 <head>
  <link href="styles/style.css" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <meta charset="utf-8">
  <title>Магазин электроники</title>
    </head>
    <body>
  <div class="logoblock">
  <img class="logomain" src="/logos/cover-cut.png">
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
</body>
</html>