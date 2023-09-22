<?php 
    session_start();
    require_once('../functions/f_apiItems.php');
    $codigoanuncio = $_POST['codigoanuncio'];
    $getItems = getItems($codigoanuncio);

    if($getItems == false){
        $_SESSION['alert-contavinculada'] = 'Houve um <b>erro no código informado</b>, corrija!';
        header('location:../user/dashboard.php');
    }else{

    $sellerid = $getItems['seller_id'];
    $_SESSION['contavinculada'] = $sellerid;
    $_SESSION['alert-contavinculada'] = 'Conta <b>vinculada</b> com sucesso!';
    header('location:../user/dashboard.php');


    }


