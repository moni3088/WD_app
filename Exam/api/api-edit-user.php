<?php
// The id that the client passes
$sSelectedUserId = $_GET['id'];

$arrayNewUser = [];
$arrayCurrentUser = [];

$user = json_decode('{}');
$user->firstName = $_POST["firstName"];
$user->lastName = $_POST["lastName"];
$user->userName = $_POST["userName"];
$user->email = $_POST["email"];
$user->password = $_POST["password"];

//convert user object to json
$jUser = json_encode($user);

//convert json object to associative array & push it to the arrayNewUser
$decodedNewUserData = json_decode($jUser,true);
array_push($arrayNewUser, $decodedNewUserData);

//get content of users.txt and convert the json objects to associative array
$jsonString = file_get_contents( '../data/users.txt', FILE_USE_INCLUDE_PATH );
$decodedCurrentUsers = json_decode($jsonString, true);
array_push($arrayCurrentUser, $decodedCurrentUsers);




/*print_r(count($arrayCurrentUser));*/



/*$jsonString = file_get_contents( '../data/users.txt', FILE_USE_INCLUDE_PATH );
// convert the text to an object (array)
$decodedUsers = json_decode( $jsonString );
// Get rid of the price from the array
for($i = 0; $i < count($decodedUsers); $i++){
    //$jItem = $aData[$i];
    if( $decodedUsers[$i]->id == $sSelectedUserId){
        if($decodedUsers[$i]->firstName != $user->firstName){

        }
    }
}

$stringArrayUsers = json_encode(array_values( $decodedUsers ));
file_put_contents("../data/users.txt", $stringArrayUsers, FILE_USE_INCLUDE_PATH);*/

?>