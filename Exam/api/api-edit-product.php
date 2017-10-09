<?php
// The id that the client passes
$sSelectedProductId = $_GET['id'];

$productName = $_POST["productName"];
$productCategory = $_POST["productCategory"];
$productPrice = $_POST["price"];
$productStock = $_POST["stock"];

//get content of users.txt and convert the json objects to associative array
$jsonString = file_get_contents( '../data/products.txt', FILE_USE_INCLUDE_PATH );
$decodedCurrentProducts = json_decode($jsonString, true);

for($i=0; $i<sizeof($decodedCurrentProducts); $i++){
    if($sSelectedProductId == $decodedCurrentProducts[$i]["id"]){
        if(($decodedCurrentProducts[$i]["productName"]!=$productName) &&
            ($productName!=null)){
            $decodedCurrentProducts[$i]["productName"]=$productName;
        }

        if(($decodedCurrentProducts[$i]["productCategory"]!=$productCategory) &&
            ($productCategory!=null)){
            $decodedCurrentProducts[$i]["productCategory"]=$productCategory;
        }
        if(($decodedCurrentProducts[$i]["price"]!=$productPrice) &&
            ($productPrice!=null)){
            $decodedCurrentProducts[$i]["price"]=$productPrice;
        }

        if(($decodedCurrentProducts[$i]["stock"]!=$productStock) &&
            ($productStock!=null)){
            $decodedCurrentProducts[$i]["stock"]=$productStock;
        }

    }
}


$encodedCurrentProducts = json_encode(array_values($decodedCurrentProducts));

file_put_contents("../data/products.txt", $encodedCurrentProducts, FILE_USE_INCLUDE_PATH);

echo $encodedCurrentProducts;


?>