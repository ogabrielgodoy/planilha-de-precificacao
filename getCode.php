<?php 
session_start();

$code = $_GET['code'];
$state = $_GET['state'];

if(isset($_GET['error'])){
    echo $_GET['error_description'];
    echo '<br>';
    echo $_GET['error_description'];
    echo '<br>';
    echo 'consulte o administrador do sistema';
    exit;
}

//Trocar code por token
$accessTokenUrl = 'https://api.mercadolibre.com/oauth/token';
$clientId = '1409468665877545'; // ID DO APP
$clientSecret = 'NHFzLCJgaWtyiq4OrIsoxfyrGYtdykgr'; // SENHA DO APP
$authorizationCode = $code;
$redirectUri = 'https://localhost/planilha-de-precificacao/getCode.php';

require_once('functions/f_trocarCodePorToken.php');

    $response = trocarCodePorToken($accessTokenUrl, $clientId, $clientSecret,$authorizationCode,$redirectUri);
    $_SESSION['user'] = $response;
    header('location:https://localhost/planilha-de-precificacao/scripts/s_config.php');
