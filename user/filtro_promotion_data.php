<?php

function filtroPromotionData($SESSION_USER_ACESSTOKEN, $MLB){
    require_once('../functions/f_apiSellerPromotions.php');
    require_once('../functions/f_convertDateFormat.php');

    $id = $MLB;
    $promotion = apiSellerPromotions($SESSION_USER_ACESSTOKEN, $id);
    $promotion = json_decode($promotion, true);
    //print_r($promotion);
    
    $ordemDoArray = 0;
    foreach ($promotion as $promo) {
        if ($promo['status'] === "started") {
            if($ordemDoArray === 0){
                return convertDateFormat($promo['finish_date']);
                $ordemDoArray = $ordemDoArray + 1;
            }else{
                exit;
            }
        }else{
            return "Sem promoção ativa";
            exit;
        }
    }
}