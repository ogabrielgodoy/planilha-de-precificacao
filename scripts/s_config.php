<?php
// Converte os dados que vem pela sessão em um array
// Sobre o if, se não for um array ele converte.
session_start();
if(!is_array($_SESSION['user'])){
    $jsonUser = $_SESSION['user'];
    $_SESSION['user'] = json_decode($jsonUser, true);
}
header('location:../user/dashboard.php');