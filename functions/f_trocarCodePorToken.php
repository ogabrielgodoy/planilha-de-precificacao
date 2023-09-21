<?php 

function trocarCodePorToken($accessTokenUrl,$clientId,$clientSecret,$authorizationCode,$redirectUri){
    
    $data = array(
        'grant_type' => 'authorization_code',
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'code' => $authorizationCode,
        'redirect_uri' => $redirectUri,
    );
    
    $options = array(
        CURLOPT_URL => $accessTokenUrl,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_RETURNTRANSFER => true,
    );
    
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    // $response contém a resposta da solicitação
    return $response;
    }