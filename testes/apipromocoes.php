<?php 
session_start();
require_once('../functions/f_apiSellerPromotions.php');


$id = "MLB3928351002";
// Modulo promoção:
$promo = apiSellerPromotions($_SESSION['user']['access_token'], $id);		

$promo = json_decode($promo);

var_dump($promo);

?>
<hr>
<?php

// Function to convert date format
function convertDateFormat($inputDate) {
    $date = new DateTime($inputDate);
    return $date->format('d/m/Y \a\s H:i:s');
}

// Loop through the array and display relevant information
// foreach ($promo as $promotion) {
//     if (isset($promotion->start_date) && isset($promotion->price) && isset($promotion->finish_date)) {
//         echo "Promotion Name: " . $promotion->name . "<br>";
//         echo "Start Date: " . convertDateFormat($promotion->start_date) . "<br>";
//         echo "Price: $" . $promotion->price . "<br>";
//         echo "End Date: " . convertDateFormat($promotion->finish_date) . "<br><br>";
//     }
    
// }

foreach ($promo as $promotion) {
    if (isset($promotion->finish_date)) {
        echo "Nome: " . $promotion->name . "<br>";
        echo "Termina em: " . convertDateFormat($promotion->finish_date) . "<br>";
    }
}