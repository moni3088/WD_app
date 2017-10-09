<?php
// The id that the client passes
$sSelectedUserId = $_GET['id'];

$userFirstName = $_POST["firstName"];
$userLastName = $_POST["lastName"];
$userUserName = $_POST["userName"];
$userEmail = $_POST["email"];

//get content of users.txt and convert the json objects to associative array
$jsonString = file_get_contents( '../data/users.txt', FILE_USE_INCLUDE_PATH );
$decodedCurrentUsers = json_decode($jsonString, true);

for($i=0; $i<sizeof($decodedCurrentUsers);$i++){
    if($sSelectedUserId == $decodedCurrentUsers[$i]["id"]){
        if(($decodedCurrentUsers[$i]["firstName"]!=$userFirstName) &&
            ($userFirstName!=null)){
            $decodedCurrentUsers[$i]["firstName"]=$userFirstName;
        }

        if(($decodedCurrentUsers[$i]["lastName"]!=$userLastName) &&
            ($userLastName!=null)){
            $decodedCurrentUsers[$i]["lastName"]=$userLastName;
        }
        if(($decodedCurrentUsers[$i]["userName"]!=$userUserName) &&
            ($userUserName!=null)){
            $decodedCurrentUsers[$i]["userName"]=$userUserName;
        }

        if(($decodedCurrentUsers[$i]["email"]!=$userEmail) &&
            ($userEmail!=null)){
            $decodedCurrentUsers[$i]["email"]=$userEmail;
        }

    }
}


$encodedCurrentUsers = json_encode(array_values($decodedCurrentUsers));

file_put_contents("../data/users.txt", $encodedCurrentUsers, FILE_USE_INCLUDE_PATH);

echo $encodedCurrentUsers;


?>