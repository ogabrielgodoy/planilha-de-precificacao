<?php 

function getItems($IDITEM){
    
    // https://developers.mercadolivre.com.br/pt_br/itens-e-buscas

    $OFFSET = 0;
    $lIMIT = 1;
    $api = "https://api.mercadolibre.com/items/" . $IDITEM;

    // Faz a requisição à API do Mercado Livre
    $response = @file_get_contents($api);

    // Verifica se houve algum erro durante a requisição
    if ($response === false) {
        //$error = error_get_last();
        //echo "Erro na consulta à API: " . $error['message'];
        $condicao = false;
        return $condicao;
    }else{
        $condicao = 'valido';
        // Decodifica a resposta JSON
        $dadosApiMeli = json_decode($response, true);
        return $dadosApiMeli;
        return $condicao;
    }
}