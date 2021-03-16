<!DOCTYPE HTML>
<html>
 <head>
  <link href="styles/product.css" rel="stylesheet" type="text/css">
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
<body>
	<div class="product">
		<?php
		function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
  		}
		require_once 'register/connection.php';
		if(!empty($_GET)){
			$product_id=$_GET['id'];
			$link = mysqli_connect($host, $user, $password, $database) 
    		or die("Ошибка" . mysqli_connect_error($link));
			$query ="SELECT name,picture,price,text FROM `products` where id =$product_id;";
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
			</div>";
			mysqli_close($link);
			}
		?>
	</div>
</body>
</html>