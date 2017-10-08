<?php



$product = json_decode('{}');
$product->id = uniqid();
$product->productName = $_POST["productName"];
$product->productCategory = $_POST["productCategory"];
$product->price = $_POST["price"];
$product->stock = $_POST["stock"];

$currentProducts = [];

$jsonString = file_get_contents( '../data/products.txt', FILE_USE_INCLUDE_PATH );
$decodedProducts = json_decode($jsonString);

if ($decodedProducts != null) {
    $currentProducts = $decodedProducts;
}

array_push($currentProducts, $product);

$products = json_encode(array_values($currentProducts));

file_put_contents("../data/products.txt", $products, FILE_USE_INCLUDE_PATH);

echo $products;



?>