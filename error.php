<html>
 <head>
  <meta charset="utf-8">
  <title>Ошибка</title>
  <link href="styles/register.css" rel="stylesheet" type="text/css">
  <link href="styles/style.css" rel="stylesheet" type="text/css">
 </head>
 <body>
  <div>
    <?php
  if(!empty($_GET)){
      echo "<h1 class='error'>".$_GET['msg']."</h1>";
  } else {
    echo "Error 404";
  }
?> 
 </div>
 </form>
 </body>
</html>