<?php
session_start();

$userName = $_POST["email"];
$userPass = $_POST["password"];

$sAdminData = file_get_contents( '../data/admin.txt', FILE_USE_INCLUDE_PATH );
$arrayAdminData = json_decode( $sAdminData );
$sCientData = file_get_contents( '../data/users.txt', FILE_USE_INCLUDE_PATH );
$arrayClientData = json_decode( $sCientData );

$isAdmin='';

for($i = 0; $i < count($arrayAdminData); $i++){
    if(($arrayAdminData[$i]->userName == $userName)&&($arrayAdminData[$i]->password == $userPass)){
        $_SESSION['userName'] = $userName;
        // send this to the user
        $sjResponse = '{"login":"admin","user":"'.$userName.'"}';
        echo $sjResponse;
        exit;

    }
    $isAdmin=false;
}

if ($isAdmin==false){
    for($i = 0; $i < count($arrayClientData); $i++){
        if(($arrayClientData[$i]->userName == $userName)&&($arrayClientData[$i]->password == $userPass)){
            $_SESSION['userName'] = $userName;
            // send this to the user
            $sjResponse = '{"login":"client","user":"'.$userName.'"}';
            echo $sjResponse;
            exit;
        }
    }
}

$sjResponse = '{"login":"error"}';
echo $sjResponse;
exit;


?>