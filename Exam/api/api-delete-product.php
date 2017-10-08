<?php

// The id that the client passes
$sSelectedProductId = $_GET['id'];

$jsonString = file_get_contents( '../data/products.txt', FILE_USE_INCLUDE_PATH );
// convert the text to an object (array)
$decodedProducts = json_decode( $jsonString );
// Get rid of the price from the array
for($i = 0; $i < count($decodedProducts); $i++){
    //$jItem = $aData[$i];
    if( $decodedProducts[$i]->id == $sSelectedProductId){
        unset($decodedProducts[$i]);
    }
}

$stringArrayProducts = json_encode(array_values( $decodedProducts ));
file_put_contents("../data/products.txt", $stringArrayProducts, FILE_USE_INCLUDE_PATH);


?>