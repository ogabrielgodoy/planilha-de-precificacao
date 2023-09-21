<?php 

function apiSellerPromotions($ACCESS_TOKEN, $IDITEM){
$access_token = $ACCESS_TOKEN; // Substitua pelo seu token de acesso


// Aqui você pode obter todas as promoções que o item possuí e os estados das promoções no momento da consulta.
// https://developers.mercadolivre.com.br/pt_br/gerenciar-ofertas#Consultar-as-promoções-de-itens
$api_url = "https://api.mercadolibre.com/seller-promotions/items/" . $IDITEM . "?app_version=v2";

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $access_token
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    //echo 'Erro na requisição: ' . curl_error($ch);
    return curl_error($ch);
} else {
    //echo 'Resposta da API:';
    return $response;
}

curl_close($ch);
}