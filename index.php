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
   <div class="usersbut">
    <form class="btn" action="login.php" type="get">
    <p><input type="submit" value="Войти"></p>
    </form>
    <form class="btn" action="register.php" type="get">
    <p><input type="submit" value="Зарегистрироваться"></p>
  </form>
  </div>
  </div>
  <div class="main">
    <?php 
  echo "<div class='category_rows'>";
  require_once 'register/connection.php'; //подключаем скрипт
  $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка" . mysqli_connect_error($link));
  $query ="SELECT * FROM `category`;";
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
<div class="product_rows">
  <?php
  require_once 'register/connection.php';
  function showProducts($result){
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
  }
  if(!empty($_POST)){
    $category_id = $_POST['category_id'];
    $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка" . mysqli_connect_error($link));
  $query ="SELECT * FROM `products` where category_id=$category_id;";
  $result = mysqli_query($link, $query) or die(mysqli_error($link)); 
  showProducts($result);
  }
  else{
  $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка" . mysqli_connect_error($link));
  $query ="SELECT * FROM `products`;";
  $result = mysqli_query($link, $query) or die(mysqli_error($link)); 
  showProducts($result);
  }
  echo"</div>";
    ?>
</div>
</div>
</body>
<footer>
</footer>
</html>