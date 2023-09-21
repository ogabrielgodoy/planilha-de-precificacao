<?php 

session_start();
unset($_SESSION['contavinculada']);
$_SESSION['alert-contavinculada'] = 'Conta <b>desvinculada</b> com sucesso!';
header('location:../user/dashboard.php');