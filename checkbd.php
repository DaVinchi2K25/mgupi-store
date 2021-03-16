<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div>
<?php 
	require_once 'register/connection.php'; //подключаем скрипт
	$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка" . mysqli_connect_error($link));
	$query ="SELECT * FROM `category`;";
	$result = mysqli_query($link, $query) or die(mysqli_error($link)); 
	while ($obj = mysqli_fetch_object($result)){
		echo "<a href='/?category_id=$obj->id'>$obj->name</a>";
	}
	mysqli_close($link);
?>
</div>
</body>
</html>
