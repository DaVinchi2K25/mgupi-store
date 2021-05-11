<html>
 <head>
  <meta charset="utf-8">
  <link href="styles/register.css" rel="stylesheet" type="text/css">
  <title>Магазин электроники</title>
 </head>
 <body>
  <div class="regform">
 <form action="/register.php" method="POST">
 <a href="/">
 <img class="logo" src="/logos/cover.png">
 </a>
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

