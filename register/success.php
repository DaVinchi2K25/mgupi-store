<html>
 <head>
  <meta charset="utf-8">
  <title>Магазин электроники</title>
  <link href="/styles/register.css" rel="stylesheet" type="text/css">
  <link href="/styles/regsuccess.css" rel="stylesheet" type="text/css">
 </head>
 <body>
 	<h1>Спасибо за регистрацию.</h1>
    <h2> <?php
     if(!empty($_GET)){
        $msg = $_GET['msg'];
        echo "Подтверждение отправлено на электронный адрес:".$msg;
        echo '<script>setTimeout(\'location="/"\', 5000)</script>';
        } else{
           header("Location: /error"); 
        }?></h2>
 </body>
 <footer>
 	<h4>Powered by Da_Vinchi Technologies</h2>
 </footer>
</html>