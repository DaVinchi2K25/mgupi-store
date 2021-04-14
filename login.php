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
 <p><?php if(!empty($_GET) && $_GET['status']=='success'){ echo $_GET['msg']; echo '<script>setTimeout(\'location="/"\', 1000)</script>';} else{
  if(empty($_GET)) { echo "<b>Введите логин и пароль для входа</b>";}else{
    echo $_GET['msg'];
  }}?></p>
  <p>Логин<br><input type="email" name="login" required></p>
  <p>Пароль<br><input type="password" name="password" required></p>
  <p><input type="submit"></p>
 </form>
 </body>
</html>