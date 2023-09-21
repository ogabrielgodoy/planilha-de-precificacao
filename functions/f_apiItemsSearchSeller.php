<?php 

function getAdsAccount($IDSITE, $IDUSER){
    
    // sites/$SITE_ID/search?seller_id=$SELLER_ID 
    // Permite listar itens por vendedor.
    // https://developers.mercadolivre.com.br/pt_br/itens-e-buscas

    $OFFSET = 0;
    $LIMIT = 50;

    //$api = "https://api.mercadolibre.com/sites/$IDSITE/search?seller_id=$IDUSER&offset=$OFFSET&limit=$LIMIT";
    $api = "https://api.mercadolibre.com/sites/$IDSITE/search?seller_id=$IDUSER";

    // Faz a requisição à API do Mercado Livre
    $response = @file_get_contents($api);

    // Verifica se houve algum erro durante a requisição
    if ($response === false) {
        //$error = error_get_last();
        //echo "Erro na consulta à API: " . $error['message'];
        $condicao = 'naovalido';
        return $condicao;
    }else{
        $condicao = 'valido';
        // Decodifica a resposta JSON
        $dadosApiMeli = json_decode($response, true);
        return $dadosApiMeli;
        return $condicao;
    }
}