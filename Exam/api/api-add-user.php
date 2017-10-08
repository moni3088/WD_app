<?php



$user = json_decode('{}');
$user->id = uniqid();
$user->firstName = $_POST["firstName"];
$user->lastName = $_POST["lastName"];
$user->userName = $_POST["userName"];
$user->email = $_POST["email"];
$user->password = $_POST["password"];

$currentUsers = [];

$jsonString = file_get_contents( '../data/users.txt', FILE_USE_INCLUDE_PATH );
$decodedUsers = json_decode($jsonString);

if ($decodedUsers != null) {
    $currentUsers = $decodedUsers;
}

array_push($currentUsers, $user);

$users = json_encode(array_values($currentUsers));

file_put_contents("../data/users.txt", $users, FILE_USE_INCLUDE_PATH);

echo $users;

?>