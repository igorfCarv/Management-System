<?php 

session_start();

if(!isset($_SESSION['user_ok']))
    header("Location: login.php");

if(isset($_GET["logout"])){
    unset($_SESSION['user_ok']);
    header("Location: login.php");
}

?>

<h1> Bem vindo a aera restrita</h1>
<a href="index.php?lout=true">Sair</a>