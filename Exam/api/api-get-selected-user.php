<?php


// The id that the client passes
$sSelectedUserId = $_GET['id'];

$jsonString = file_get_contents( '../data/users.txt', FILE_USE_INCLUDE_PATH );
// convert the text to an object (array)
$decodedUsers = json_decode( $jsonString );
// Get rid of the price from the array
for($i = 0; $i < count($decodedUsers); $i++){
    //$jItem = $aData[$i];
    if( $decodedUsers[$i]->id == $sSelectedUserId){
        return $decodedUsers;
        break;
    }
}




?>