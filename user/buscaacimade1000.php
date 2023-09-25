<?php 
session_start();

$USER_ID = 1299501714;
$access_token = $_SESSION['user']['access_token'];

// $access_token = $ACCESS_TOKEN; // Substitua pelo seu token de acesso

//https://developers.mercadolivre.com.br/pt_br/itens-e-buscas#Modo-de-busca-acima-de-1000-registros
$api_url = "https://api.mercadolibre.com/users/$USER_ID/items/search?search_type=scan";

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $access_token
]);

$response = curl_exec($ch);
curl_close($ch);

//Vai ter a resposta scroll_id
//echo $response;

$response = json_decode($response);
$scroll_id = $response->scroll_id;

$api_url = "https://api.mercadolibre.com/users/$USER_ID/items/search?search_type=scan&scroll_id=" . $scroll_id;

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $access_token
]);

$response = curl_exec($ch);
curl_close($ch);

echo $response;


//var_dump($_SESSION['user']);