<?php 

// Function to convert date format
function convertDateFormat($inputDate) {
    $date = new DateTime($inputDate);
    return $date->format('d/m/Y \a\s H:i:s');
}