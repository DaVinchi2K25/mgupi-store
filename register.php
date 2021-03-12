<html>
 <head>
  <meta charset="utf-8">
  <link href="styles/register.css" rel="stylesheet" type="text/css">
  <title>Магазин электроники</title>
 </head>
 <body>
  <div class="regform">
 <form action="/register.php" method="POST">
 <img class="logo" src="/logos/cover.png">
 <p><b>Заполните все поля для регистрации</b></p>
 <p><?php if(!empty($_GET)){
   echo $_GET['msg'];
 }?></p>
 <p>Логин<br><input class="reg" type="email" name="login" required></p>
 <p>Пароль<br><input class="reg" type="password" name="password" required></p>
 <p>Имя<br><input class="reg" type="name" name="name"required></p>
 <p><input type="submit"></p>
 </form>
</div>
  <div class="php">
  <?php
  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }
  function set_user($login,$password_hash,$name)
  {
  require_once 'register/connection.php'; //подключаем скрипт
  // подключаемся к серверу
  $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка" . mysqli_connect_error($link));
  $query ="INSERT users(email,password,name) VALUES ('$login','$password_hash','$name');";
  $result = mysqli_query($link, $query) or die(mysqli_error($link)); 
  if($result)
  {
    echo "успех";
    header("Location: /register/success.php?msg=".$login); /* Перенаправление браузера */
    exit;
  } else {
    header("Location: /register.php?msg=error ".$mysqli_error()); /* Перенаправление браузера */
  }
  mysqli_close($link);
  }
 if(!empty($_POST)){
 if(isset($_POST['login']) && isset($_POST['password'])){
   if(!empty($_POST['login']) && !empty($_POST['login'])){
     $login=$_POST['login'];
     if($_POST['password'] !=""){
     $password = password_hash(test_input($_POST['password']),PASSWORD_BCRYPT);
     } else {
      header("Location: /register.php?msg=пароль оказался пустым");
      exit;
     }
     $name = $_POST['name'];
     set_user($login,$password,$name);
  } else {
   echo "Заполните все поля и попробуйте снова.";
  }
  }
}
  ?>
 </div>
<div>
</div>
 </body>
</html>

