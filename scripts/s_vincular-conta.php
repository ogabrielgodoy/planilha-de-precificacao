<?php 
    session_start();
    require_once('../functions/f_apiItems.php');
    $codigoanuncio = $_POST['codigoanuncio'];
    $getItems = getItems($codigoanuncio);
    $sellerid = $getItems['seller_id'];

    $_SESSION['contavinculada'] = $sellerid;
    $_SESSION['alert-contavinculada'] = 'Conta <b>vinculada</b> com sucesso!';
    header('location:../user/dashboard.php');