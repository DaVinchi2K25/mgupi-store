<html>
 <head>
  <meta charset="utf-8">
  <title>Магазин электроники</title>
  <link href="styles/register.css" rel="stylesheet" type="text/css">
  <link href="styles/style.css" rel="stylesheet" type="text/css">
 </head>
 <body>
  <div>
    <?php
  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }
  function check_user($login,$password_hash)
  {
    require_once 'register/connection.php'; //подключаем скрипт
  // подключаемся к серверу
  $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка" . mysqli_connect_error($link));
  $query ="SELECT PASSWORD FROM `users` WHERE email='$login';";
  $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link)); 
  $result = mysqli_fetch_row($result)[0];  
  if($result)
  {
  	if (password_verify($password_hash,$result))  {
      session_start(); 
      $_SESSION['login']=$login;
      header("Location: /login.php?msg=вход выполнен&status=success");
  	} else {
     header("Location: /login.php?msg=пароль введён неверно");
    }
    echo "Выполнение запроса прошло успешно";
  } else {
    header("Location: /login.php?msg=".$mysqli_error());
  }
  mysqli_close($link);
  }
if(!empty($_POST)){

  if(isset($_POST['login']) && isset($_POST['password'])){
 
    $login=$_POST['login'];
    $password = $_POST['password'];
    check_user($login,$password);
 }
}


?> 
 </div>
 <form action="login.php" method="POST">
 <a href="/"><img class="logo" src="/logos/cover.png"></a>
 <p><?php if(!empty($_GET) && $_GET['status']=='success'){ echo $_GET['msg']; echo '<script>setTimeout(\'location="/"\', 1000)</script>';} else{
  if(empty($_GET)) { echo "<b>Введите логин и пароль для входа</b>";}else{
    echo $_GET['msg'];
  }}?></p>
  <p>Логин<br><input type="email" name="login" required></p>
  <p>Пароль<br><input type="password" name="password" required></p>
  <p><input type="submit"></p>
 </form>
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