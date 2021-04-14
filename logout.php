<?php
session_start();
if(!empty($_SESSION['login'])){
	session_destroy();
	header("Location: /");
}
?>