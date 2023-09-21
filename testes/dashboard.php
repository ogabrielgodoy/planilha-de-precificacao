<?php 
session_start();
require_once('../functions/f_apiSellerPromotions.php');
echo 'seu acesso USER ID é: ' . $_SESSION['user']['user_id'];
?>
<h1>Bem vindo!</h1>
<hr>
<a href="planilha.php">Gerar planilha de precificação</a>